<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Models\ErasureRequest;
use Blomstra\Gdpr\Notifications\ErasureRequestCancelledBlueprint;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\Exception\PermissionDeniedException;
use Flarum\User\User;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class CancelErasureController extends AbstractDeleteController
{
    /**
     * @var NotificationSyncer
     */
    protected $notifications;

    public function __construct(NotificationSyncer $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @inheritDoc
     */
    public function delete(ServerRequestInterface $request)
    {
        /** @var User $actor */
        $actor = $request->getAttribute('actor');

        $id = Arr::get($request->getQueryParams(), 'id');
        $erasureRequest = ErasureRequest::where('id', $id)->firstOrFail();

        $isSelf = $actor->id === $erasureRequest->user_id;
        $appropriateStatus = $erasureRequest->status === 'awaiting_user_confirmation' || $erasureRequest->status === 'user_confirmed';
        if (!$isSelf || !$appropriateStatus) {
            throw new PermissionDeniedException();
        }

        $this->notifications->sync(new ErasureRequestCancelledBlueprint($erasureRequest), [$actor]);
    }
}
