<?php

namespace Blomstra\Gdpr;

use Illuminate\Support\Arr;

final class DataProcessor
{
    protected static $types = [
        Data\Assets::class, Data\Posts::class,
    ];

    public static function addType(string $type)
    {
        static::$types[] = $type;
    }

    public static function removeType(string $type)
    {
        static::$types = Arr::except(static::$types, $type);
    }

    public static function setTypes(array $types)
    {
        static::$types = $types;
    }

    public function types(): array
    {
        return static::$types;
    }
}
