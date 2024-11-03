<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api\Controller;

use Carbon\Carbon;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Gdpr\Notifications\ErasureRequestCancelledBlueprint;
use Flarum\Http\RequestUtil;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\Exception\PermissionDeniedException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class DeleteErasureRequestController extends AbstractDeleteController
{
    public function __construct(protected NotificationSyncer $notifications)
    {
    }

    public function delete(ServerRequestInterface $request)
    {
        $actor = RequestUtil::getActor($request);
        $actor->assertRegistered();

        $id = Arr::get($request->getQueryParams(), 'id');
        $erasureRequest = ErasureRequest::query()->where('id', $id)->firstOrFail();

        $isSelf = $actor->id === $erasureRequest->user_id;
        $appropriateStatus = $erasureRequest->status === 'awaiting_user_confirmation' || $erasureRequest->status === 'user_confirmed';
        if (!$isSelf && $actor->cannot('processErasure') || !$appropriateStatus) {
            throw new PermissionDeniedException();
        }

        $erasureRequest->status = ErasureRequest::STATUS_CANCELLED;
        $erasureRequest->cancelled_at = Carbon::now();

        $erasureRequest->save();

        $this->notifications->sync(new ErasureRequestCancelledBlueprint($erasureRequest), [$erasureRequest->user]);
    }
}
