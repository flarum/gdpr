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

use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;

class DeleteUserTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
            ],
        ]);

        $this->extension('blomstra-gdpr');
    }

    /**
     * @test
     */
    public function delete_user_endpoint_is_processed_by_this_extension()
    {
        $response = $this->send(
            $this->request(
                'DELETE',
                '/api/users/2',
                [
                    'authenticatedAs' => 1,
                ]
            )
        );

        $this->assertEquals(204, $response->getStatusCode());

        $user = User::query()->where('id', 2)->with('erasureRequest')->first();
        $this->assertNotNull($user);
        $this->assertEquals("Anonymous{$user->erasureRequest->id}", $user->username);
        $this->assertEquals(ErasureRequest::STATUS_MANUAL, $user->erasureRequest->status);
    }
}
