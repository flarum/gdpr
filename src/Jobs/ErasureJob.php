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
use Flarum\Api\ApiKey;
use Flarum\Http\AccessToken;
use Flarum\Queue\AbstractJob;
use Flarum\User\EmailToken;
use Flarum\User\LoginProvider;
use Flarum\User\PasswordToken;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Str;

class ErasureJob extends AbstractJob
{
    /**
     * @var ErasureRequest
     */
    private $erasureRequest;

    /**
     * @var Builder
     */
    protected $schema;

    public function __construct(ErasureRequest $erasureRequest)
    {
        $this->erasureRequest = $erasureRequest;
    }

    public function handle(ConnectionInterface $connection, DataProcessor $processor, Dispatcher $events): void
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

        $this->sendUserConfirmation($username, $email);

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

    private function sendUserConfirmation(string $username, string $email): void
    {
        // TODO
    }
}
