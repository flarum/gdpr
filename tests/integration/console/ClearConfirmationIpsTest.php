<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Tests\integration\console;

use Carbon\Carbon;
use Flarum\Gdpr\Console\ClearConfirmationIps;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;

class ClearConfirmationIpsTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();
        $this->extension('flarum-gdpr');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
                ['id' => 3, 'username' => 'user3', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'user3@machine.local', 'is_email_confirmed' => 1],
                ['id' => 4, 'username' => 'user4', 'password' => '$2y$10$LO59tiT7uggl6Oe23o/O6.utnF6ipngYjvMvaxo1TciKqBttDNKim', 'email' => 'user4@machine.local', 'is_email_confirmed' => 1],
            ],
            'gdpr_erasure' => [
                // Confirmed 91 days ago — IP should be cleared.
                ['id' => 1, 'user_id' => 2, 'verification_token' => null, 'status' => 'user_confirmed', 'created_at' => Carbon::now()->subDays(100), 'user_confirmed_at' => Carbon::now()->subDays(91), 'confirmation_ip' => '1.2.3.4'],
                // Confirmed 89 days ago — IP should be retained.
                ['id' => 2, 'user_id' => 3, 'verification_token' => null, 'status' => 'user_confirmed', 'created_at' => Carbon::now()->subDays(90), 'user_confirmed_at' => Carbon::now()->subDays(89), 'confirmation_ip' => '5.6.7.8'],
                // No IP stored — unaffected.
                ['id' => 3, 'user_id' => 4, 'verification_token' => null, 'status' => 'user_confirmed', 'created_at' => Carbon::now()->subDays(100), 'user_confirmed_at' => Carbon::now()->subDays(91), 'confirmation_ip' => null],
            ],
        ]);
    }

    /**
     * @test
     */
    public function clears_ip_for_requests_older_than_90_days()
    {
        $this->app();

        $command = new ClearConfirmationIps();
        $command->handle();

        $this->assertNull(ErasureRequest::query()->find(1)->confirmation_ip);
    }

    /**
     * @test
     */
    public function retains_ip_for_requests_within_90_days()
    {
        $this->app();

        $command = new ClearConfirmationIps();
        $command->handle();

        $this->assertEquals('5.6.7.8', ErasureRequest::query()->find(2)->confirmation_ip);
    }

    /**
     * @test
     */
    public function does_not_affect_requests_without_ip()
    {
        $this->app();

        $command = new ClearConfirmationIps();
        $command->handle();

        $this->assertNull(ErasureRequest::query()->find(3)->confirmation_ip);
    }
}
