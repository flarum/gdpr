<?php

namespace Blomstra\Gdpr\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;

class RequestDeletionSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'user-deletion-request';

    /**
     * {@inheritdoc}
     */
    protected function getDefaultAttributes($deletion_request)
    {
        return [
            'status'             => $deletion_request->status,
            'reason'             => $deletion_request->reason,
            'createdAt'          => $this->formatDate($deletion_request->created_at)
        ];
    }

    /**
     * @param $request
     *
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function user($deletion_request)
    {
        return $this->hasOne($deletion_request, BasicUserSerializer::class);
    }
}
