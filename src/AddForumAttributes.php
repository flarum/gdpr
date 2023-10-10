<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

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
