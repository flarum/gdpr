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

use Carbon\Carbon;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;
use Flarum\User\User;

class ProcessErasureTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->setting('mail_driver', 'log');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
                ['id' => 3, 'username' => 'moderator', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'moderator@machine.local', 'is_email_confirmed' => 1],
                ['id' => 4, 'username' => 'user4', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'user4@machine.local', 'is_email_confirmed' => 1],
                ['id' => 5, 'username' => 'user5', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'user5@machine.local', 'is_email_confirmed' => 1, 'joined_at' => Carbon::now(), 'last_seen_at' => Carbon::now(), 'avatar_url' => 'avatar.jpg'],
            ],
            'groups' => [
                ['id' => 5, 'name_singular' => 'customgroup', 'name_plural' => 'customgroups'],
            ],
            'group_user' => [
                ['user_id' => 3, 'group_id' => 4],
                ['user_id' => 5, 'group_id' => 5],
            ],
            'group_permission' => [
                ['permission' => 'processErasure', 'group_id' => 4],
            ],
            'gdpr_erasure' => [
                ['id' => 1, 'user_id' => 4, 'verification_token' => 'abc123', 'status' => 'awaiting_user_confirmation', 'reason' => 'I want to be forgotten', 'created_at' => Carbon::now()],
                ['id' => 2, 'user_id' => 5, 'verification_token' => '123abc', 'status' => 'user_confirmed', 'reason' => 'I also want to be forgotten', 'created_at' => Carbon::now(), 'user_confirmed_at' => Carbon::now()],
            ],
        ]);

        $this->extension('blomstra-gdpr');
    }

    /**
     * @test
     */
    public function unauthorized_users_cannot_see_erasure_requests()
    {
        $response = $this->send(
            $this->request('GET', '/api/user-erasure-requests', [
                'authenticatedAs' => 2,
            ])
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function authorized_users_can_see_confirmed_erasure_requests()
    {
        $response = $this->send(
            $this->request('GET', '/api/user-erasure-requests', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertCount(1, $json['data']);
        $this->assertEquals('user_confirmed', $json['data'][0]['attributes']['status']);
    }

    /**
     * @test
     */
    public function unauthorized_user_cannot_process_erasure_request()
    {
        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 2,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I am trying to process this request',
                        ],
                        'meta' => [
                            'mode' => 'deletion',
                        ],
                    ],
                ],
            ])
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function authorized_user_cannot_process_unconfirmed_request()
    {
        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/1', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I am trying to process this request',
                        ],
                        'meta' => [
                            'mode' => 'deletion',
                        ],
                    ],
                ],
            ])
        );

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function authorized_user_can_process_confirmed_erasure_request_in_deletion_mode()
    {
        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'deletion',
                    ],
                ],
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals('processed', $json['data']['attributes']['status']);
        $this->assertEquals('deletion', $json['data']['attributes']['processedMode']);
        $this->assertEquals('I have processed this request', $json['data']['attributes']['processorComment']);

        $this->assertNull(User::find(5));
    }

    /**
     * @test
     */
    public function authorized_user_can_process_confirmed_erasure_request_in_anonymization_mode()
    {
        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'anonymization',
                    ],
                ],
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $json = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals('processed', $json['data']['attributes']['status']);
        $this->assertEquals('anonymization', $json['data']['attributes']['processedMode']);
        $this->assertEquals('I have processed this request', $json['data']['attributes']['processorComment']);

        $user = User::where('id', 5)->with('groups')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Anonymous#2', $user->username);
        $this->assertEquals("{$user->username}@flarum-gdpr.local", $user->email);
        $this->assertEquals(0, $user->is_email_confirmed);
        $this->assertEmpty($user->last_seen_at);
        $this->assertNull($user->avatar_url);
        $this->assertEmpty($user->groups);
    }

    /**
     * @test
     */
    public function authorized_user_cannot_process_confirmed_erasure_request_in_anonymization_mode_if_not_allowed()
    {
        $this->setting('blomstra-gdpr.allow-anonymization', false);

        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'anonymization',
                    ],
                ],
            ])
        );

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function authorized_user_cannot_process_confirmed_erasure_request_in_deletion_mode_if_not_allowed()
    {
        $this->setting('blomstra-gdpr.allow-deletion', false);

        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'deletion',
                    ],
                ],
            ])
        );

        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function user_is_anonymized_when_nicknames_is_enabled()
    {
        $this->extension('flarum-nicknames');
        $this->app();

        User::unguard();
        User::find(5)->update(['nickname' => 'Custom-nickname']);
        User::reguard();

        $this->assertEquals('Custom-nickname', User::find(5)->nickname);

        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'anonymization',
                    ],
                ],
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $user = User::find(5);
        $this->assertNotNull($user);
        $this->assertEquals('Anonymous#2', $user->username);
        $this->assertNull($user->nickname);
    }

    /**
     * @test
     */
    public function user_bio_is_anonimized()
    {
        $this->extension('fof-user-bio');
        $this->app();

        User::unguard();
        User::find(5)->update(['bio' => 'Custom bio']);
        User::reguard();

        $this->assertEquals('Custom bio', User::find(5)->bio);

        $response = $this->send(
            $this->request('PATCH', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 3,
                'json'            => [
                    'data' => [
                        'attributes' => [
                            'processor_comment' => 'I have processed this request',
                        ],
                    ],
                    'meta' => [
                        'mode' => 'anonymization',
                    ],
                ],
            ])
        );

        $this->assertEquals(200, $response->getStatusCode());

        $user = User::find(5);
        $this->assertNotNull($user);
        $this->assertEquals('Anonymous#2', $user->username);
        $this->assertNull($user->bio);
    }
}
