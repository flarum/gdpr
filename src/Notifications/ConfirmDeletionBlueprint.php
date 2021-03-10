<?php

namespace Blomstra\Gdpr\Notifications;

use Blomstra\Gdpr\Models\DeletionRequest;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ConfirmDeletionBlueprint implements BlueprintInterface, MailableInterface
{
/**
     * @var DeletionRequest
     */
    private $request;

    public function __construct(DeletionRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritDoc
     */
    public function getFromUser()
    {
        return $this->request->user;
    }

    /**
     * @inheritDoc
     */
    public function getSubject()
    {
        return $this->request;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return [
            'deletion-request' => $this->request->id
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getType()
    {
        return 'user-deletion-request';
    }

    /**
     * @inheritDoc
     */
    public static function getSubjectModel()
    {
        return DeletionRequest::class;
    }

    /**
     * @inheritDoc
     */
    public function getEmailView()
    {
        return 'gdpr::confirm-deletion';
    }

    /**
     * @inheritDoc
     */
    public function getEmailSubject(TranslatorInterface $translator)
    {
        return $translator->trans('blomstra-gdpr.email.confirm_deletion.subject');
    }
}