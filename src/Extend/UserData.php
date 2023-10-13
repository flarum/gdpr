<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Extend;

use Blomstra\Gdpr\DataProcessor;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class UserData implements ExtenderInterface
{
    protected array $types = [];
    protected array $removeTypes = [];
    protected array $removeUserColumns = [];
    
    public function extend(Container $container, Extension $extension = null)
    {
        foreach ($this->types as $type) {
            DataProcessor::addType($type);
        }

        foreach ($this->removeTypes as $type) {
            DataProcessor::removeType($type);
        }

        if (!empty($this->removeUserColumns)) {
            DataProcessor::removeUserColumns($this->removeUserColumns);
        }
    }

    /**
     * Register a new data type and methods.
     * 
     * Must be a class that implements Blomstra\Gdpr\Contracts\DataType.
     *
     * @param string $type
     * @return self
     */
    public function addType(string $type): self
    {
        $this->types[] = $type;

        return $this;
    }

    /**
     * Removes a data type from exports.
     *
     * @param string $type
     *
     * @return self
     */
    public function removeType(string $type): self
    {
        $this->removeTypes[] = $type;

        return $this;
    }

    /**
     * Removes a user table column from exports.
     *
     * @param string $column
     *
     * @return self
     */
    public function removeUserColumn(string $column): self
    {
        $columns = (array) $column;

        $this->removeUserColumns = array_merge($this->removeUserColumns, $columns);

        return $this;
    }

    /**
     * Removes multiple user table columns from exports.
     *
     * @param array $columns
     * @return self
     */
    public function removeUserColumns(array $columns): self
    {
        $this->removeUserColumns = array_merge($this->removeUserColumns, $columns);

        return $this;
    }
}
