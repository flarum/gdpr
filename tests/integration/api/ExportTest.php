<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\tests\integration\api;

use Blomstra\Gdpr\Models\Export;
use Flarum\Foundation\Paths;
use Flarum\Notification\Notification;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;
use PhpZip\ZipFile;

class ExportTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    protected $response;
    protected $export;

    public function setUp(): void
    {
        parent::setUp();

        $this->setting('mail_driver', 'log');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
            ],
        ]);

        $this->extension('blomstra-gdpr');

        $this->makeExportRequest();
    }

    protected function makeExportRequest(): void
    {
        $this->response = $this->send(
            $this->request(
                'POST',
                '/api/gdpr/export',
                [
                    'authenticatedAs' => 2,
                ]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->export = Export::query()->where('user_id', 2)->first();
    }

    /**
     * @test
     */
    public function guests_cannot_request_export_data()
    {
        $response = $this->send(
            $this->request(
                'POST',
                '/api/gdpr/export',
                [
                    'json' => [
                        'data' => [],
                    ],
                ]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function users_can_request_export_data()
    {
        $this->assertEquals(201, $this->response->getStatusCode());
    }

    /**
     * @test
     */
    public function notification_is_created_after_requesting_export_data()
    {
        $notification = Notification::query()->where('user_id', 2)->where('type', 'gdprExportAvailable')->first();
        $this->assertNotNull($notification);
    }

    /**
     * @test
     */
    public function export_is_created_after_requesting_export_data()
    {
        $user = User::query()->where('id', 2)->first();
        $fileName = $this->export->file;

        $this->assertEquals(2, $this->export->user_id);
        $this->assertStringStartsWith("gdpr-export-{$user->username}", $fileName);
    }

    /**
     * @test
     */
    public function export_file_exists_in_storage()
    {
        $paths = $this->app()->getContainer()->make(Paths::class);
        $this->assertFileExists($paths->storage.DIRECTORY_SEPARATOR.'gdpr-exports'.DIRECTORY_SEPARATOR.$this->export->id);
    }

    /**
     * @test
     */
    public function authenticated_user_can_retrieve_export_file_via_controller()
    {
        $fileName = $this->export->file;
        $response = $this->send(
            $this->request(
                'GET',
                '/gdpr/export/'.$fileName,
                ['authenticatedAs' => 2]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(200, $response->getStatusCode());
        $data = $response->getBody()->getContents();
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     */
    public function unauthenticated_user_can_retrieve_export_file_via_controller()
    {
        $fileName = $this->export->file;
        $response = $this->send(
            $this->request(
                'GET',
                '/gdpr/export/'.$fileName,
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(200, $response->getStatusCode());
        $data = $response->getBody()->getContents();
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     */
    public function zip_file_contains_expected_json_files()
    {
        $paths = $this->app()->getContainer()->make(Paths::class);
        $zipFilePath = $paths->storage.DIRECTORY_SEPARATOR.'gdpr-exports'.DIRECTORY_SEPARATOR.$this->export->id;

        $zip = new ZipFile();
        $zip->openFile($zipFilePath);

        $actualFiles = $zip->getListFiles();

        // Expected files without dynamic keys
        $expectedFilesStatic = ['user.json'];

        // Check static expected files are present
        foreach ($expectedFilesStatic as $expectedFile) {
            $this->assertTrue(in_array($expectedFile, $actualFiles), "Expected file {$expectedFile} not found in zip.");
        }

        // Check for dynamic expected files
        $accessTokenFiles = array_filter($actualFiles, function ($fileName) {
            return strpos($fileName, 'token-AccessToken-') === 0 && preg_match('/token-AccessToken-\d+\.json/', $fileName);
        });

        $this->assertNotEmpty($accessTokenFiles, 'No token-AccessToken-#.json file found in zip.');

        // Create a combined list of all expected files (static + dynamic)
        $allExpectedFiles = array_merge($expectedFilesStatic, $accessTokenFiles);

        // Ensure no additional unexpected files
        foreach ($actualFiles as $actualFile) {
            $this->assertTrue(in_array($actualFile, $allExpectedFiles), "Unexpected file {$actualFile} found in zip.");
        }

        $zip->close();
    }
}
