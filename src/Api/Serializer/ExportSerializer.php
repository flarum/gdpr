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
use Flarum\Gdpr\Models\Export;
use InvalidArgumentException;
use Tobscure\JsonApi\Relationship;

class ExportSerializer extends AbstractSerializer
{
    protected $type = 'exports';

    /**
     * {@inheritdoc}
     *
     * @param Export $export
     *
     * @throws InvalidArgumentException
     */
    protected function getDefaultAttributes($export)
    {
        $attributes = [
            'file'         => $export->file,
            'createdAt'    => $this->formatDate($export->created_at),
            'destroysAt'   => $this->formatDate($export->destroys_at),
        ];

        return $attributes;
    }

    protected function user($export): Relationship
    {
        return $this->hasOne($export, BasicUserSerializer::class);
    }

    protected function actor($export): Relationship
    {
        return $this->hasOne($export, BasicUserSerializer::class);
    }
}
