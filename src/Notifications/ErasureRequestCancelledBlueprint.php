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

use Blomstra\Gdpr\Models\ErasureRequest;
use Carbon\Carbon;
use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\Notification\MailableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ErasureRequestCancelledBlueprint implements BlueprintInterface, MailableInterface
{
    public function __construct(private ErasureRequest $request)
    {
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
            'erasure-request' => $this->request->id,
            'timestamp'       => Carbon::now(),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getType()
    {
        return 'gdpr_erasure_cancelled';
    }

    /**
     * @inheritDoc
     */
    public static function getSubjectModel()
    {
        return ErasureRequest::class;
    }

    /**
     * @inheritDoc
     */
    public function getEmailView()
    {
        return 'gdpr::erasure-cancelled';
    }

    /**
     * @inheritDoc
     */
    public function getEmailSubject(TranslatorInterface $translator)
    {
        return $translator->trans('blomstra-gdpr.email.erasure_cancelled.subject');
    }
}
