<?php

namespace Blomstra\Gdpr;

use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Api\Serializer\ForumSerializer;

class AddForumAttributes
{
    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        $attributes['canProcessErasureRequests'] = $serializer->getActor()->can('processErasure');

        if ($attributes['canProcessErasureRequests']) {
            $attributes['erasureRequestCount'] = ErasureRequest::query()->where('status', 'user_confirmed')->count();
        }

        return $attributes;
    }
}
