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

use Blomstra\Gdpr\Jobs\ErasureJob;
use Blomstra\Gdpr\Jobs\GdprJob;
use Blomstra\Gdpr\Models\ErasureRequest;
use Carbon\Carbon;
use Flarum\Api\Controller\AbstractDeleteController;
use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\UserRepository;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Arr;
use Psr\Http\Message\ServerRequestInterface;

class DeleteUserController extends AbstractDeleteController
{
    public function __construct(protected UserRepository $users, protected SettingsRepositoryInterface $settings, protected Queue $queue)
    {
    }

    public function delete(ServerRequestInterface $request): void
    {
        $actor = RequestUtil::getActor($request);
        $user = $this->users->findOrFail(Arr::get($request->getQueryParams(), 'id'), $actor);
        $mode = Arr::get($request->getQueryParams(), 'mode', $this->settings->get('blomstra-gdpr.default-erasure'));

        if (!in_array($mode, [ErasureRequest::MODE_ANONYMIZATION, ErasureRequest::MODE_DELETION])) {
            throw new \InvalidArgumentException('Invalid erasure mode');
        }

        $actor->assertCan('delete', $user);


        ErasureRequest::unguard();

        $erasureRequest = ErasureRequest::firstOrNew([
            'user_id' => $user->id,
        ]);

        $erasureRequest->user_id = $user->id;
        $erasureRequest->status = ErasureRequest::STATUS_MANUAL;
        $erasureRequest->created_at = Carbon::now();
        $erasureRequest->processed_mode = $mode;
        $erasureRequest->processed_at = Carbon::now();
        $erasureRequest->processed_by = $actor->id;

        $erasureRequest->save();

        ErasureRequest::reguard();

        $this->queue->push(
            job: new ErasureJob($erasureRequest),
            queue: GdprJob::$onQueue
        );
    }
}
