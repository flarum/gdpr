<?php

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Api\Serializer\RequestDeletionSerializer;
use Blomstra\Gdpr\Command\RequestDeletion;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\User;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class RequestDeletionController extends AbstractCreateController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = RequestDeletionSerializer::class;
    
    /**
     * @var Dispatcher
     */
    protected $bus;
    
    public function __construct(Dispatcher $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @inheritDoc
     */
    public function data(ServerRequestInterface $request, Document $document): ResponseInterface
    {
        /** @var User $actor */
        $actor = $request->getAttribute('actor');

        $actor->assertRegistered();

        if (!$actor->checkPassword(Arr::get($request->getParsedBody(), 'meta.password'))) {
            throw new NotAuthenticatedException();
        }

        return $this->bus->dispatch(new RequestDeletion($actor, Arr::get($request->getParsedBody(), 'data', [])));
    }
}
