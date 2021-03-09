<?php

namespace Blomstra\Gdpr\Api\Serializer;

use Blomstra\Gdpr\Models\Export;
use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Api\Serializer\BasicUserSerializer;
use InvalidArgumentException;

class ExportSerializer extends AbstractSerializer
{
    /**
     * {@inheritdoc}
     */
    protected $type = 'exports';

    /**
     * {@inheritdoc}
     *
     * @param Export $export
     * @throws InvalidArgumentException
     */
    protected function getDefaultAttributes($export)
    {
        $attributes = [
            'file'      => $export->file,
            'createdAt'   => $this->formatDate($export->created_at),
            'destroysAt'   => $this->formatDate($export->destroys_at)
        ];

        return $attributes;
    }

    /**
     * @return \Tobscure\JsonApi\Relationship
     */
    protected function user($post)
    {
        return $this->hasOne($post, BasicUserSerializer::class);
    }
}
