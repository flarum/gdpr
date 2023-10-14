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
    public function __construct(protected DataProcessor $processor)
    {
    }

    public function __invoke(ForumSerializer $serializer, $model, array $attributes): array
    {
        $actor = $serializer->getActor();

        if ($actor->isAdmin()) {
            $types = $this->processor->types();
            $attributes['gdpr-data-types'] = array_combine(
                $types,
                array_map(function ($type) {
                    return $type::dataType();
                }, $types)
            );
        }

        $attributes['canProcessErasureRequests'] = $actor->can('processErasure');

        if ($attributes['canProcessErasureRequests']) {
            $attributes['erasureRequestCount'] = ErasureRequest::query()->where('status', ErasureRequest::STATUS_USER_CONFIRMED)->count();
        }

        return $attributes;
    }
}
