<?php

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Models\ErasureRequest;
use Blomstra\Gdpr\Notifications\ConfirmErasureBlueprint;
use Flarum\Api\Controller\AbstractCreateController;
use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\User;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class RequestErasureController extends AbstractCreateController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = RequestErasureSerializer::class;
    
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

        $reason = $request->getAttribute('attributes.reason');

        $token = Str::random(40);

        ErasureRequest::unguard();

        $erasureRequest = ErasureRequest::firstOrNew([
            'user_id' => $actor->id,
        ]);

        $erasureRequest->user_id = $actor->id;
        $erasureRequest->status = 'sent';
        $erasureRequest->reason = empty($reason) ? null : $reason;
        $erasureRequest->verification_token = $token;
        $erasureRequest->created_at = Carbon::now();

        $erasureRequest->save();

        $this->notifications->sync(new ConfirmErasureBlueprint($erasureRequest), [$actor]);

        return $erasureRequest;
    }
}
