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
use Flarum\Http\RequestUtil;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\Exception\PermissionDeniedException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class CancelErasureController extends AbstractDeleteController
{
    public function __construct(protected NotificationSyncer $notifications)
    {
    }

    public function delete(ServerRequestInterface $request)
    {
        $actor = RequestUtil::getActor($request);

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
