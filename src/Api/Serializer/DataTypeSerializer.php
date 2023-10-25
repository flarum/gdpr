<?php

namespace Blomstra\Gdpr\Api\Serializer;

use Blomstra\Gdpr\Contracts\DataType;
use Flarum\Api\Serializer\AbstractSerializer;

class DataTypeSerializer extends AbstractSerializer
{
    protected $type = 'gdpr-datatypes';
    
    /**
     * @param object $model
     * @return array
     */
    public function getDefaultAttributes($model): array
    {
        /** @var DataType $datatype */
        $datatype = $model->class;

        return [
            'description' => $datatype::exportDescription(),
            'anonymizeDescription' => $datatype::anonymizeDescription(),
            'deleteDescription' => $datatype::deleteDescription(),
            'extension' => $model->extension,
        ];
    }

    /**
     * @param object $model
     * @return string
     */
    public function getId($model): string
    {
        return $model->class;
    }
}
