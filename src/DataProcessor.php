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

final class DataProcessor
{
    private static $types = [
        Data\Forum::class,
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
        self::$types = array_values(array_diff(self::$types, [$type]));
    }

    public static function setTypes(array $types)
    {
        self::$types = $types;
    }

    public static function removeUserColumns(array $columns)
    {
        self::$removeUserColumns = array_merge(self::$removeUserColumns, $columns);
    }

    /**
     * @return \Blomstra\Gdpr\Contracts\DataType[]
     */
    public function types(): array
    {
        return self::$types;
    }

    public function removableUserColumns(): array
    {
        return self::$removeUserColumns;
    }
}
