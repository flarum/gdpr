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

use Flarum\Gdpr\Jobs\ExportJob;
use Flarum\Gdpr\Jobs\GdprJob;
use Flarum\Http\RequestUtil;
use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\User;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Arr;
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

        $user = User::query()->where('id', Arr::get($request->getParsedBody(), 'data.attributes.userId'))->firstOrFail();

        if ($actor->isNot($user)) {
            $actor->assertCan('exportFor', $user);
        }

        $this->queue->push(
            job: new ExportJob($user, $actor),
            queue: GdprJob::$onQueue
        );

        return new EmptyResponse(201);
    }
}
