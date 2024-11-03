<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Notifications;

use Carbon\Carbon;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\User\User;
use Symfony\Contracts\Translation\TranslatorInterface;

class ErasureRequestCancelledBlueprint implements BlueprintInterface, MailableInterface
{
    public function __construct(private ErasureRequest $request)
    {
    }

    public function getFromUser(): ?User
    {
        return $this->request->user;
    }

    public function getSubject(): ErasureRequest
    {
        return $this->request;
    }

    public function getData(): array
    {
        return [
            'erasure-request' => $this->request->id,
            'timestamp'       => Carbon::now(),
        ];
    }

    public static function getType(): string
    {
        return 'gdpr_erasure_cancelled';
    }

    public static function getSubjectModel(): string
    {
        return ErasureRequest::class;
    }

    public function getEmailView(): array
    {
        return ['text' => 'flarum-gdpr::erasure-cancelled'];
    }

    public function getEmailSubject(TranslatorInterface $translator): string
    {
        return $translator->trans('flarum-gdpr.email.erasure_cancelled.subject');
    }
}
