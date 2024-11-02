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

use Flarum\Api\Controller\AbstractShowController;
use Flarum\Foundation\ValidationException;
use Flarum\Gdpr\Api\Serializer\RequestErasureSerializer;
use Flarum\Gdpr\Jobs\ErasureJob;
use Flarum\Gdpr\Jobs\GdprJob;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ProcessErasureController extends AbstractShowController
{
    public $serializer = RequestErasureSerializer::class;

    public function __construct(protected Queue $queue, protected SettingsRepositoryInterface $settings)
    {
    }

    public function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);

        $actor->assertCan('processErasure');

        $id = Arr::get($request->getQueryParams(), 'id');

        $mode = Arr::get($request->getParsedBody(), 'data.attributes.meta.mode');

        if ($this->settings->get('blomstra-gdpr.allow-anonymization') === false && $mode === ErasureRequest::MODE_ANONYMIZATION) {
            throw new ValidationException(['mode' => 'Anonymization is not enabled.']);
        }
        if ($this->settings->get('blomstra-gdpr.allow-deletion') === false && $mode === ErasureRequest::MODE_DELETION) {
            throw new ValidationException(['mode' => 'Deletion is not enabled.']);
        }

        $erasureRequest = ErasureRequest::findOrFail($id);

        // if the request is not confirmed, or already processed we should not proceed, but throw an error
        if ($erasureRequest->status !== ErasureRequest::STATUS_USER_CONFIRMED || $erasureRequest->user_confirmed_at === null) {
            throw new ValidationException(['user' => 'Erasure request is not confirmed.']);
        }

        $erasureRequest->status = ErasureRequest::STATUS_PROCESSED;
        $erasureRequest->processed_mode = $mode;
        $erasureRequest->processed_at = Carbon::now();
        $erasureRequest->processed_by = $actor->id;
        $erasureRequest->processor_comment = Arr::get($request->getParsedBody(), 'data.attributes.processor_comment');

        $erasureRequest->save();

        $this->queue->push(
            job: new ErasureJob($erasureRequest),
            queue: GdprJob::$onQueue
        );

        return $erasureRequest;
    }
}
