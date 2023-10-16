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

use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;

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
    public function delete_user_is_unavailable()
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

        $this->assertEquals(405, $response->getStatusCode());
    }
}
