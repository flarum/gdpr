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

use Flarum\Api\Controller\AbstractCreateController;
use Flarum\Foundation\ValidationException;
use Flarum\Gdpr\Api\Serializer\RequestErasureSerializer;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Gdpr\Notifications\ConfirmErasureBlueprint;
use Flarum\Http\RequestUtil;
use Flarum\Notification\NotificationSyncer;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class CreateErasureRequestController extends AbstractCreateController
{
    public $serializer = RequestErasureSerializer::class;

    public function __construct(protected NotificationSyncer $notifications)
    {
    }

    public function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);

        $actor->assertRegistered();

        // If they signed up using a third party oauth provider, they won't have a password
        // so we can't check it. We'll just assume they're authenticated.
        if ($actor->loginProviders()->count() === 0 && !$actor->checkPassword(Arr::get($request->getParsedBody(), 'meta.password', ''))) {
            throw new ValidationException(['password' => 'Incorrect password']);
        }

        $reason = Arr::get($request->getParsedBody(), 'data.attributes.reason');

        $token = Str::random(40);

        ErasureRequest::unguard();

        $erasureRequest = ErasureRequest::firstOrNew([
            'user_id' => $actor->id,
        ]);

        $erasureRequest->user_id = $actor->id;
        $erasureRequest->status = ErasureRequest::STATUS_AWAITING_USER_CONFIRMATION;
        $erasureRequest->reason = $reason;
        $erasureRequest->verification_token = $token;
        $erasureRequest->created_at = Carbon::now();

        $erasureRequest->save();

        ErasureRequest::reguard();

        $this->notifications->sync(new ConfirmErasureBlueprint($erasureRequest), [$actor]);

        return $erasureRequest;
    }
}
