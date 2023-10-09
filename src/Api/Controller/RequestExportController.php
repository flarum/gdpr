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
use Flarum\Http\RequestUtil;
use Flarum\User\User;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Validation\UnauthorizedException;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestExportController implements RequestHandlerInterface
{
    public function __construct(protected Queue $queue)
    {
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var User $actor */
        $actor = RequestUtil::getActor($request);

        if (!$actor) {
            throw new UnauthorizedException();
        }

        $this->queue->push(new ExportJob($actor));

        return new EmptyResponse(201);
    }
}
