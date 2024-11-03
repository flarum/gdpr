<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Notifications;

use Flarum\Gdpr\Models\Export;
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

    public function getActor(): ?User
    {
        return $this->export->actor;
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
        return ['text' => 'flarum-gdpr::export-available'];
    }

    public function getEmailSubject(TranslatorInterface $translator): string
    {
        return $translator->trans('flarum-gdpr.email.export_available.subject');
    }
}
