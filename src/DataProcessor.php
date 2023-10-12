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

use Illuminate\Support\Arr;

final class DataProcessor
{
    private static $types = [
        Data\Assets::class, Data\Posts::class,
        Data\Tokens::class, Data\Discussions::class,
        // Ought to be last at all times.
        Data\User::class,
    ];

    private static array $removeUserColumns = [];

    public static function addType(string $type)
    {
        self::$types[] = $type;
    }

    public static function removeType(string $type)
    {
        self::$types = Arr::except(self::$types, $type);
    }

    public static function setTypes(array $types)
    {
        self::$types = $types;
    }

    public static function removeUserColumns(array $columns)
    {
        self::$removeUserColumns = self::$removeUserColumns + $columns;
    }

    public function types(): array
    {
        return self::$types;
    }

    public function removableUserColumns(): array
    {
        return self::$removeUserColumns;
    }
}
