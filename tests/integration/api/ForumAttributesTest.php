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

use Blomstra\Gdpr\Data\Forum;
use Blomstra\Gdpr\Data\User;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Illuminate\Support\Arr;

class ForumAttributesTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->extension('blomstra-gdpr');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
                ['id' => 3, 'username' => 'moderator', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'moderator@machine.local', 'is_email_confirmed' => 1],
            ],
            'group_user' => [
                ['user_id' => 3, 'group_id' => 4],
            ],
            'group_permission' => [
                ['permission' => 'processErasure', 'group_id' => 4],
            ],
        ]);
    }

    /**
     * @test
     */
    public function erasure_methods_are_serialized_and_with_the_correct_type()
    {
        $response = $this->send(
            $this->request(
                'GET',
                '/api',
                [
                    'authenticatedAs' => null,
                ]
            )
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertArrayHasKey('erasureAnonymizationAllowed', $json['data']['attributes']);
        $this->assertArrayHasKey('erasureDeletionAllowed', $json['data']['attributes']);

        $this->assertIsBool($json['data']['attributes']['erasureAnonymizationAllowed']);
        $this->assertIsBool($json['data']['attributes']['erasureDeletionAllowed']);

        $this->assertTrue($json['data']['attributes']['erasureAnonymizationAllowed']);
        $this->assertFalse($json['data']['attributes']['erasureDeletionAllowed']);
    }

    /**
     * @test
     */
    public function normal_users_do_not_see_gdpr_data()
    {
        $response = $this->send(
            $this->request(
                'GET',
                '/api',
                [
                    'authenticatedAs' => 2,
                ]
            )
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertArrayNotHasKey('gdpr-data-types', $json['data']['attributes']);
        $this->assertFalse($json['data']['attributes']['canProcessErasureRequests']);
        $this->assertArrayNotHasKey('erasureRequestCount', $json['data']['attributes']);
    }

    /**
     * @test
     */
    public function admins_see_gdpr_data()
    {
        $response = $this->send(
            $this->request(
                'GET',
                '/api',
                [
                    'authenticatedAs' => 1,
                ]
            )
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertTrue($json['data']['attributes']['canProcessErasureRequests']);
        $this->assertArrayHasKey('erasureRequestCount', $json['data']['attributes']);
    }

    /**
     * @test
     */
    public function user_with_permission_can_see_gdpr_data()
    {
        $response = $this->send(
            $this->request(
                'GET',
                '/api',
                [
                    'authenticatedAs' => 3,
                ]
            )
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertArrayNotHasKey('gdpr-data-types', $json['data']['attributes']);

        $this->assertTrue($json['data']['attributes']['canProcessErasureRequests']);
        $this->assertArrayHasKey('erasureRequestCount', $json['data']['attributes']);
    }
}
