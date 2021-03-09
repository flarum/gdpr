<?php

namespace Blomstra\Gdpr\Notifications;



use Blomstra\Gdpr\Models\Export;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Symfony\Component\Translation\TranslatorInterface;

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

    /**
     * @inheritDoc
     */
    public function getFromUser()
    {
        return $this->export->user;
    }

    /**
     * @inheritDoc
     */
    public function getSubject()
    {
        return $this->export;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return [
            'export' => $this->export->id
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getType()
    {
        return 'gdpr-export-available';
    }

    /**
     * @inheritDoc
     */
    public static function getSubjectModel()
    {
        return Export::class;
    }

    /**
     * @inheritDoc
     */
    public function getEmailView()
    {
        return 'gdpr::export-available';
    }

    /**
     * @inheritDoc
     */
    public function getEmailSubject(TranslatorInterface $translator)
    {
        return $translator->trans('blomstra-gdpr.email.export_available.subject');
    }
}
