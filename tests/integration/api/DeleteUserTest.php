<?php

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

        $this->assertEquals(404, $response->getStatusCode());
    }
}
