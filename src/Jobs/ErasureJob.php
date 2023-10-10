<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Jobs;

use Blomstra\Gdpr\DataProcessor;
use Blomstra\Gdpr\Events\Erased;
use Blomstra\Gdpr\Events\Erasing;
use Blomstra\Gdpr\Models\ErasureRequest;
use Blomstra\Gdpr\Notifications\ErasureCompletedBlueprint;
use Flarum\Queue\AbstractJob;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Schema\Builder;
use Illuminate\Mail\Message;
use Symfony\Contracts\Translation\TranslatorInterface;

class ErasureJob extends AbstractJob
{
    protected Builder $schema;

    public function __construct(private ErasureRequest $erasureRequest)
    {
    }

    public function handle(ConnectionInterface $connection, DataProcessor $processor, Dispatcher $events, Mailer $mailer, TranslatorInterface $translator): void
    {
        $this->schema = $connection->getSchemaBuilder();

        /** @var User */
        $user = User::find($this->erasureRequest->user_id);

        if (!$user) {
            return;
        }

        // Store these props here, as they'll be erased/anonymized in a moment
        $username = $user->getDisplayNameAttribute();
        $email = $user->email;

        $mode = $this->erasureRequest->processed_mode;

        $events->dispatch(new Erasing(
            $this->erasureRequest
        ));

        $this->{$mode}($user, $processor);

        $this->sendUserConfirmation($username, $email, $mailer, $translator);

        $events->dispatch(new Erased(
            $username,
            $email,
            $mode
        ));
    }

    private function deletion(User $user, DataProcessor $processor): void
    {
        foreach ($processor->types() as $type) {
            (new $type($user))->delete();
        }
    }

    private function anonymization(User $user, DataProcessor $processor): void
    {
        foreach ($processor->types() as $type) {
            (new $type($user))->anonymize();
        }
    }

    private function sendUserConfirmation(string $username, string $email, Mailer $mailer, TranslatorInterface $translator): void
    {
        $blueprint = new ErasureCompletedBlueprint($this->erasureRequest, $username);

        $mailer->send(
            $blueprint->getEmailView(),
            $blueprint->getData(),
            function (Message $message) use ($username, $email, $blueprint, $translator) {
                $message->to($email, $username)
                    ->subject($blueprint->getEmailSubject($translator));
            }
        );
    }
}
