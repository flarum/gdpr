<?php

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Jobs\ExportJob;
use Flarum\User\User;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Validation\UnauthorizedException;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RequestExportController implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var User $actor */
        $actor = $request->getAttribute('actor');

        if (! $actor) {
            throw new UnauthorizedException;
        }
        /** @var Queue $queue */
        $queue = app(Queue::class);

        $queue->push(new ExportJob($actor));

        return new EmptyResponse(201);
    }
}
