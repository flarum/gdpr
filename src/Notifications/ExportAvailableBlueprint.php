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
use Flarum\Gdpr\Models\Export;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\User\User;
use Flarum\Locale\TranslatorInterface;

class ExportAvailableBlueprint implements BlueprintInterface, MailableInterface, AlertableInterface
{
    /**
     * @var Export
     */
    private $export;

    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    public function getFromUser(): ?User
    {
        return $this->export->user;
    }

    public function getActor(): ?User
    {
        return $this->export->actor;
    }

    public function getSubject(): ?AbstractModel
    {
        return $this->export;
    }

    public function getData(): mixed
    {
        return [
            'export' => $this->export->id,
        ];
    }

    public static function getType(): string
    {
        return 'gdprExportAvailable';
    }

    public static function getSubjectModel(): string
    {
        return Export::class;
    }

    public function getEmailViews(): array
    {
        return ['text' => 'flarum-gdpr::email.text.export-available', 'html' => 'flarum-gdpr::email.html.export-available'];
    }

    public function getEmailSubject(TranslatorInterface $translator): string
    {
        return $translator->trans('flarum-gdpr.email.export_available.subject');
    }
}
