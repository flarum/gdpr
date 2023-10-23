<?php

namespace Blomstra\Gdpr\tests\unit;

use Blomstra\Gdpr\Data;
use Blomstra\Gdpr\DataProcessor;
use Flarum\Testing\unit\TestCase;

class DataProcessorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Resetting the types and removeUserColumns properties before each test
        DataProcessor::setTypes([
            Data\Forum::class,
            Data\Assets::class, Data\Posts::class,
            Data\Tokens::class, Data\Discussions::class,
            Data\User::class,
        ]);
        DataProcessor::removeUserColumns([]);
    }

    /**
     * @test
     */
    public function it_can_add_a_new_type()
    {
        // Given
        $newType = 'TestData\TypeExample';
        $processor = new DataProcessor();

        // When
        DataProcessor::addType($newType);

        // Then
        $this->assertContains($newType, $processor->types());
    }

    /**
     * @test
     */
    public function it_can_remove_a_type()
    {
        // Given
        $typeToRemove = Data\Tokens::class;
        $processor = new DataProcessor();

        // When
        DataProcessor::removeType($typeToRemove);

        // Then
        $this->assertNotContains($typeToRemove, $processor->types());
    }

    /**
     * @test
     */
    public function it_can_set_types()
    {
        // Given
        $newTypes = ['TestData\TypeA', 'TestData\TypeB'];
        $processor = new DataProcessor();

        // When
        DataProcessor::setTypes($newTypes);

        // Then
        $this->assertEquals($newTypes, $processor->types());
    }

    /**
     * @test
     */
    public function it_can_add_removable_user_columns()
    {
        // Given
        $newColumns = ['columnA', 'columnB'];
        $processor = new DataProcessor();

        // When
        DataProcessor::removeUserColumns($newColumns);

        // Then
        $this->assertEquals($newColumns, $processor->removableUserColumns());
    }
}
