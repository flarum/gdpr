<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api\Serializer;

use Flarum\Api\Serializer\AbstractSerializer;
use Flarum\Gdpr\Contracts\DataType;

class DataTypeSerializer extends AbstractSerializer
{
    protected $type = 'gdpr-datatypes';

    /**
     * @param object $model
     *
     * @return array
     */
    public function getDefaultAttributes($model): array
    {
        /** @var DataType $datatype */
        $datatype = $model->class;

        return [
            'type'                       => $datatype::dataType(),
            'exportDescription'          => $datatype::exportDescription(),
            'anonymizeDescription'       => $datatype::anonymizeDescription(),
            'deleteDescription'          => $datatype::deleteDescription(),
            'extension'                  => $model->extension,
        ];
    }

    /**
     * @param object $model
     *
     * @return string
     */
    public function getId($model): string
    {
        return $model->class;
    }
}
