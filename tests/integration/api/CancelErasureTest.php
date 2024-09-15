<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Tests\integration\Api;

use Carbon\Carbon;
use Flarum\Extend;
use Flarum\Notification\Notification;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;

class CancelErasureTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->setting('mail_driver', 'log');

        $this->extend((new Extend\Csrf())
            ->exemptRoute('gdpr.erasure.cancel'));

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
    public function guest_cannot_cancel_unconfirmed_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/1')
        );

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function guest_cannot_cancel_confirmed_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/2')
        );

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function user_can_cancel_own_unconfirmed_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/1', [
                'authenticatedAs' => 4,
            ])
        );

        $this->assertEquals(204, $response->getStatusCode());

        $notification = Notification::query()->where('user_id', 4)->where('type', 'gdpr_erasure_cancelled')->first();

        $this->assertNotNull($notification);
    }

    /**
     * @test
     */
    public function user_can_cancel_own_confirmed_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/2', [
                'authenticatedAs' => 5,
            ])
        );

        $this->assertEquals(204, $response->getStatusCode());

        $notification = Notification::query()->where('user_id', 5)->where('type', 'gdpr_erasure_cancelled')->first();

        $this->assertNotNull($notification);
    }

    /**
     * @test
     */
    public function user_cannot_cancel_others_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/1', [
                'authenticatedAs' => 5,
            ])
        );

        $this->assertEquals(403, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function moderator_can_cancel_others_erasure_request()
    {
        $response = $this->send(
            $this->request('DELETE', '/api/user-erasure-requests/1', [
                'authenticatedAs' => 3,
            ])
        );

        $this->assertEquals(204, $response->getStatusCode());

        $notification = Notification::query()->where('user_id', 4)->where('type', 'gdpr_erasure_cancelled')->first();

        $this->assertNotNull($notification);
    }
}
