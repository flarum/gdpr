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

use Blomstra\Gdpr\Jobs\ExportJob;
use Blomstra\Gdpr\Jobs\GdprJob;
use Flarum\Http\RequestUtil;
use Flarum\User\Exception\NotAuthenticatedException;
use Illuminate\Contracts\Queue\Queue;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestExportController implements RequestHandlerInterface
{
    public function __construct(protected Queue $queue)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);

        if ($actor->isGuest()) {
            throw new NotAuthenticatedException();
        }

        $this->queue->push(
            job: new ExportJob($actor),
            queue: GdprJob::$onQueue
        );

        return new EmptyResponse(201);
    }
}
