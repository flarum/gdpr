<?php

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Api\Serializer\RequestErasureSerializer;
use Blomstra\Gdpr\Models\ErasureRequest;
use Blomstra\Gdpr\Notifications\ConfirmErasureBlueprint;
use Flarum\Api\Controller\AbstractShowController;
use Flarum\Notification\NotificationSyncer;
use Flarum\User\Exception\NotAuthenticatedException;
use Flarum\User\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ProcessErasureController extends AbstractShowController
{
    /**
     * {@inheritdoc}
     */
    public $serializer = RequestErasureSerializer::class;

    /**
     * @var NotificationSyncer
     */
    protected $notifications;

    public function __construct(NotificationSyncer $notifications) {
        $this->notifications = $notifications;
    }

    /**
     * @inheritDoc
     */
    public function data(ServerRequestInterface $request, Document $document)
    {
        /** @var User $actor */
        $actor = $request->getAttribute('actor');

        $actor->assertCan('processErasure');

        $id = Arr::get($request->getQueryParams(), 'id');

        $erasureRequest = ErasureRequest::findOrFail($id);

        $erasureRequest->status = 'processed';
        $erasureRequest->processed_mode = Arr::get($request->getParsedBody(), 'meta.mode');
        $erasureRequest->processed_at = Carbon::now();
        $erasureRequest->processed_by = $actor->id;
        $erasureRequest->processor_comment = Arr::get($request->getParsedBody(), 'data.attributes.processor_comment');

        $erasureRequest->save();

        // TODO: Process the erasure
        // TODO: Notify the user

        return $erasureRequest;
    }
}
