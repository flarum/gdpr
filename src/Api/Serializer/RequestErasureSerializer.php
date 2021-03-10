<?php

namespace Blomstra\Gdpr\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;

class RequestErasureSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'user-erasure-request';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($erasure_request)
    {
        return [
            'id'                 => $erasure_request->id,
            'status'             => $erasure_request->status,
            'reason'             => $erasure_request->reason,
            'createdAt'          => $this->formatDate($erasure_request->created_at),
            'userConfirmedAt'    => $this->formatDate($erasure_request->user_confirmed_at),
            'processedBy'        => $erasure_request->processed_by,
            'processorComment'   => $erasure_request->processor_comment,
            'processedAt'        => $this->formatDate($erasure_request->processed_at)
        ];
    }

    /**
     * @param $request
     *
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function user($erasure_request)
    {
        return $this->hasOne($erasure_request, BasicUserSerializer::class);
    }
}
