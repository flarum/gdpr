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
    protected static $types = [
        Data\Assets::class, Data\Posts::class,
        Data\Tokens::class,
        // Ought to be last at all times.
        Data\User::class,
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
