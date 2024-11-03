<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr;

use Flarum\Api\Serializer\ForumSerializer;
use Flarum\Gdpr\Models\ErasureRequest;

class AddForumAttributes
{
    public function __construct(protected DataProcessor $processor)
    {
    }

    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        $actor = $serializer->getActor();

        $attributes['canProcessErasureRequests'] = $actor->can('processErasure');

        if ($attributes['canProcessErasureRequests']) {
            $attributes['erasureRequestCount'] = ErasureRequest::query()->where('status', ErasureRequest::STATUS_USER_CONFIRMED)->count();
        }

        return $attributes;
    }
}
