<?php

namespace Blomstra\Gdpr\tests\unit;

use Blomstra\Gdpr\Data\Type;
use Flarum\Testing\unit\TestCase;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\Http\UrlGenerator;
use Symfony\Contracts\Translation\TranslatorInterface;
use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Database\AbstractModel;
use Illuminate\Contracts\Filesystem\Filesystem;
use PhpZip\ZipFile;
use Mockery as m;

class TypeTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_the_correct_disk_instance()
    {
        // Mocking the dependencies
        $user = m::mock(User::class);
        $erasureRequest = m::mock(ErasureRequest::class);
        $factory = m::mock(Factory::class);
        $settings = m::mock(SettingsRepositoryInterface::class);
        $url = m::mock(UrlGenerator::class);
        $translator = m::mock(TranslatorInterface::class);

        // Mock the factory to return a specific disk when called
        $diskName = 'mockedDisk';
        $mockedDisk = m::mock('overload:' . Filesystem::class);
        $factory->shouldReceive('disk')->with($diskName)->andReturn($mockedDisk);

        // Given
        $type = new TestableType($user, $erasureRequest, $factory, $settings, $url, $translator);

        // When
        $returnedDisk = $type->getDisk($diskName);

        // Then
        $this->assertEquals($mockedDisk, $returnedDisk);
    }

    /**
     * @test
     * @dataProvider specialCharactersProvider
     */
    public function it_does_not_escape_unicode_characters_when_encoding_for_export($input, $expected)
    {
        // Mocking the dependencies
        $user = m::mock(User::class);
        $erasureRequest = m::mock(ErasureRequest::class);
        $factory = m::mock(Factory::class);
        $settings = m::mock(SettingsRepositoryInterface::class);
        $url = m::mock(UrlGenerator::class);
        $translator = m::mock(TranslatorInterface::class);

        // Given
        $type = new TestableType($user, $erasureRequest, $factory, $settings, $url, $translator);
        $data = ['content' => $input];

        // When
        $encoded = $type->testEncodeForExport($data);

        // Then
        $this->assertStringContainsString($expected, $encoded);
    }

    public function specialCharactersProvider()
    {
        return [
            ['ß', '"content": "ß"'],
            ['ä', '"content": "ä"'],
            ['ö', '"content": "ö"'],
            ['ü', '"content": "ü"'],
            ['é', '"content": "é"'],
            ['ñ', '"content": "ñ"'],
            ['ç', '"content": "ç"'],
            ['ø', '"content": "ø"'],
            ['å', '"content": "å"'],
            ['你', '"content": "你"'],
            ['好', '"content": "好"'],
        ];
    }


    /**
     * @test
     */
    public function it_returns_the_correct_data_type()
    {
        // Mocking the dependencies
        $user = m::mock(User::class);
        $erasureRequest = m::mock(ErasureRequest::class);
        $factory = m::mock(Factory::class);
        $settings = m::mock(SettingsRepositoryInterface::class);
        $url = m::mock(UrlGenerator::class);
        $translator = m::mock(TranslatorInterface::class);

        // Given
        $type = new TestableType($user, $erasureRequest, $factory, $settings, $url, $translator);

        // When
        $dataType = $type->dataType();

        // Then
        $this->assertEquals('TestableType', $dataType);
    }

    /**
     * @test
     */
    public function it_returns_the_correct_table_columns()
    {
        // Mocking the dependencies
        $user = m::mock(User::class);
        $erasureRequest = m::mock(ErasureRequest::class);
        $factory = m::mock(Factory::class);
        $settings = m::mock(SettingsRepositoryInterface::class);
        $url = m::mock(UrlGenerator::class);
        $translator = m::mock(TranslatorInterface::class);

        // Mock a model, connection, and schema builder to return a predefined list of columns
        $model = m::mock(AbstractModel::class)->makePartial();
        $connection = m::mock('overload:Illuminate\Database\Connection');
        $schemaBuilder = m::mock('overload:Illuminate\Database\Schema\Builder');

        $columns = ['id', 'name', 'created_at'];
        $schemaBuilder->shouldReceive('getColumnListing')->andReturn($columns);
        $connection->shouldReceive('getSchemaBuilder')->andReturn($schemaBuilder);
        $model->shouldReceive('getConnection')->andReturn($connection);

        // Given
        $type = new TestableType($user, $erasureRequest, $factory, $settings, $url, $translator);

        // When
        $returnedColumns = $type->getTableColumns($model);

        // Then
        $this->assertEquals($columns, $returnedColumns);
    }
}

// TestableType class to expose protected method for testing
class TestableType extends Type
{
    public function testEncodeForExport(array $data): string
    {
        return $this->encodeForExport($data);
    }

    public function anonymize(): void
    {
    }

    public function delete(): void
    {
    }

    public function export(ZipFile $zip): void
    {
    }
}
