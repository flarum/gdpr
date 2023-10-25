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

/**
 * Class DataProcessor.
 *
 * Handles the data types and user column removal for the GDPR extension.
 */
final class DataProcessor
{
    /**
     * @var array<string, null|string> Associative array with data type class as key and extension ID as value.
     */
    private static $types = [
        Data\Forum::class       => null,
        Data\Assets::class      => null,
        Data\Posts::class       => null,
        Data\Tokens::class      => null,
        Data\Discussions::class => null,
        Data\User::class        => null, // Ought to be last at all times.
    ];

    /**
     * @var string[] List of user columns to be removed.
     */
    private static array $removeUserColumns = [];

    /**
     * Add a data type to the list.
     *
     * @param string      $class       The class name of the data type.
     * @param string|null $extensionId The ID of the extension adding the data type.
     */
    public static function addType(string $class, ?string $extensionId = null)
    {
        self::$types[$class] = $extensionId;
    }

    /**
     * Remove a data type from the list.
     *
     * @param string $class The class name of the data type to remove.
     */
    public static function removeType(string $class)
    {
        unset(self::$types[$class]);
    }

    /**
     * Set the entire list of data types.
     *
     * @param array<string, null|string> $types Associative array with data type class as key and extension ID as value.
     */
    public static function setTypes(array $types)
    {
        self::$types = $types;
    }

    /**
     * Add columns to the list of user columns to be removed.
     *
     * @param string[] $columns List of column names.
     */
    public static function removeUserColumns(array $columns)
    {
        self::$removeUserColumns = array_merge(self::$removeUserColumns, $columns);
    }

    /**
     * Retrieve the list of data types.
     *
     * @return array<string, null|string> Associative array with data type class as key and extension ID as value.
     */
    public function types(): array
    {
        return self::$types;
    }

    /**
     * Retrieve the list of user columns to be removed.
     *
     * @return string[] List of column names.
     */
    public function removableUserColumns(): array
    {
        return self::$removeUserColumns;
    }
}
