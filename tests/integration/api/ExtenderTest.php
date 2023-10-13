<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Tests\integration\api;

use Blomstra\Gdpr\Data\Forum;
use Blomstra\Gdpr\DataProcessor;
use Blomstra\Gdpr\Extend\UserData;
use Flarum\Testing\integration\TestCase;

class ExtenderTest extends TestCase
{
    /**
     * @test
     */
    public function custom_data_type_can_be_added()
    {
        $this->extend(
            (new UserData())
                ->addType(MyNewDataType::class)
        );

        $this->app();

        $types = $this->getDataProcessor()->types();

        $this->assertContains(MyNewDataType::class, $types);
        $this->assertEquals('my-new-data-type', $types[count($types) - 1]::dataType());
    }

    /**
     * @test
     */
    public function data_type_can_be_removed()
    {
        $this->extend(
            (new UserData())
                ->removeType(Forum::class)
        );

        $this->app();

        $types = $this->getDataProcessor()->types();

        $this->assertNotContains(Forum::class, $types);
    }

    /**
     * @test
     */
    public function custom_user_column_can_be_added()
    {
        $this->extend(
            (new UserData())
                ->removeUserColumn('custom_column')
        );

        $this->app();

        $columns = $this->getDataProcessor()->removableUserColumns();

        $this->assertContains('custom_column', $columns);
    }

    /**
     * @test
     */
    public function custom_user_columns_can_be_added()
    {
        $this->extend(
            (new UserData())
                ->removeUserColumns(['custom_column1', 'another_column'])
        );

        $this->app();

        $columns = $this->getDataProcessor()->removableUserColumns();

        $this->assertContains('custom_column1', $columns);
        $this->assertContains('another_column', $columns);
    }

    protected function getDataProcessor(): DataProcessor
    {
        return $this->app()->getContainer()->make(DataProcessor::class);
    }
}

class MyNewDataType
{
    public static function dataType(): string
    {
        return 'my-new-data-type';
    }
}
