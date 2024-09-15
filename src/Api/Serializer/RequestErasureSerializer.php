<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use Tobscure\JsonApi\Relationship;

class RequestErasureSerializer extends AbstractSerializer
{
    protected $type = 'user-erasure-requests';

    /**
     * @param \Flarum\Gdpr\Models\ErasureRequest $erasure_request
     *
     * @return array
     */
    protected function getDefaultAttributes($erasure_request)
    {
        return [
            'id'                 => $erasure_request->id,
            'status'             => $erasure_request->status,
            'reason'             => $erasure_request->reason,
            'createdAt'          => $this->formatDate($erasure_request->created_at),
            'userConfirmedAt'    => $this->formatDate($erasure_request->user_confirmed_at),
            'processorComment'   => $erasure_request->processor_comment,
            'processedAt'        => $this->formatDate($erasure_request->processed_at),
            'processedMode'      => $erasure_request->processed_mode,
        ];
    }

    protected function user($erasure_request): Relationship
    {
        return $this->hasOne($erasure_request, BasicUserSerializer::class);
    }

    protected function processedBy($erasure_request): Relationship
    {
        return $this->hasOne($erasure_request, BasicUserSerializer::class);
    }
}
