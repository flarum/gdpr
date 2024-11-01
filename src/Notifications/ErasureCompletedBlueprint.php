<?php

/*
 * This file is part of Flarum
 *
 * Copyright (c) 2021 Blomstra Ltd
 * Copyright (c) 2024 Flarum Foundation
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Notifications;

use Flarum\Database\AbstractModel;
use Flarum\Notification\AlertableInterface;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\User\User;
use Flarum\Locale\TranslatorInterface;

class ErasureCompletedBlueprint implements BlueprintInterface, MailableInterface, AlertableInterface
{
    public function __construct(private ErasureRequest $request, private string $username, private string $mode)
    {
    }

    public function getFromUser(): ?User
    {
        // .. we leave this empty for this message.
        return null;
    }

    public function getSubject(): ?AbstractModel
    {
        return $this->request;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function getData(): mixed
    {
        return [
            'username' => $this->username,
            'mode'     => $this->mode,
        ];
    }

    public static function getType(): string
    {
        return 'gdpr_erasure_completed';
    }

    public static function getSubjectModel(): string
    {
        return ErasureRequest::class;
    }

    public function getEmailViews(): array
    {
        return ['text' => 'flarum-gdpr::email.text.erasure-completed', 'html' => 'flarum-gdpr::email.html.erasure-completed'];
    }

    public function getEmailSubject(TranslatorInterface $translator): string
    {
        return $translator->trans("flarum-gdpr.email.erasure_completed.{$this->getMode()}.subject");
    }
}
