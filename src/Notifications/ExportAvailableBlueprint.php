<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Notifications;

use Blomstra\Gdpr\Models\Export;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Flarum\User\User;
use Symfony\Contracts\Translation\TranslatorInterface;

class ExportAvailableBlueprint implements BlueprintInterface, MailableInterface
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

    public function getSubject(): Export
    {
        return $this->export;
    }

    public function getData(): array
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

    public function getEmailView(): array
    {
        return ['text' => 'gdpr::export-available'];
    }

    public function getEmailSubject(TranslatorInterface $translator): string
    {
        return $translator->trans('blomstra-gdpr.email.export_available.subject');
    }
}
