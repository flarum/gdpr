<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr;

use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Api\Serializer\ForumSerializer;

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
