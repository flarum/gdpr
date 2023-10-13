<?php

namespace Blomstra\Gdpr\tests\integration\api;

use Blomstra\Gdpr\Models\ErasureRequest;
use Flarum\Notification\Notification;
use Flarum\Testing\integration\RetrievesAuthorizedUsers;
use Flarum\Testing\integration\TestCase;

class RequestErasureTest extends TestCase
{
    use RetrievesAuthorizedUsers;

    public function setUp(): void
    {
        parent::setUp();

        $this->setting('mail_driver', 'log');
        $this->setting('forum_title', 'Flarum Test');

        $this->prepareDatabase([
            'users' => [
                $this->normalUser(),
            ],
        ]);

        $this->extension('blomstra-gdpr');
    }

    public function tearDown(): void
    {
        parent::tearDown();

        Notification::query()->delete();
        ErasureRequest::query()->delete();
    }

    /**
     * @test
     */
    public function guest_cannot_request_erasure()
    {
        $response = $this->send(
            $this->request(
                'POST',
                '/api/user-erasure-requests',
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function user_providing_incorrect_password_cannot_request_erasure()
    {
        $response = $this->send(
            $this->request(
                'POST',
                '/api/user-erasure-requests',
                [
                    'authenticatedAs' => 2,
                    'json' => [
                        'data' => [
                            'attributes' => [
                                'reason' => 'I want to be forgotten'
                            ]
                        ],
                        'meta' => [
                            'password' => 'wrong-password',
                        ],
                    ],
                ]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(401, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function normal_user_can_request_erasure_and_recieves_notification_to_confirm()
    {
        $response = $this->send(
            $this->request(
                'POST',
                '/api/user-erasure-requests',
                [
                    'authenticatedAs' => 2,
                    'json' => [
                        'data' => [
                            'attributes' => [
                                'reason' => 'I want to be forgotten'
                            ]
                        ],
                        'meta' => [
                            'password' => 'too-obscure',
                        ],
                    ],
                ]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(201, $response->getStatusCode());

        $body = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals('user-erasure-requests', $body['data']['type']);

        $erasureId = $body['data']['id'];
        $this->assertNotNull($erasureId);

        $erasureRequest = ErasureRequest::query()->find($erasureId);

        $this->assertNotNull($erasureRequest);
        $this->assertIsString($erasureRequest->verification_token);
        $this->assertEquals('awaiting_user_confirmation', $erasureRequest->status);
        $this->assertEquals('I want to be forgotten', $erasureRequest->reason);
        $this->assertNotNull($erasureRequest->created_at);
        $this->assertNull($erasureRequest->user_confirmed_at);
        $this->assertNull($erasureRequest->processed_by);
        $this->assertNull($erasureRequest->processor_comment);
        $this->assertNull($erasureRequest->processed_at);
        $this->assertNull($erasureRequest->processed_mode);

        $notification = Notification::query()->where('user_id', 2)->where('type', 'gdpr_erasure_confirm')->orderBy('id', 'desc')->first();

        $this->assertNotNull($notification);
    }

    /**
     * @test
     */
    public function user_can_request_erasure_without_giving_reason()
    {
        $response = $this->send(
            $this->request(
                'POST',
                '/api/user-erasure-requests',
                [
                    'authenticatedAs' => 2,
                    'json' => [
                        'data' => [
                            'attributes' => [
                            ]
                        ],
                        'meta' => [
                            'password' => 'too-obscure',
                        ],
                    ],
                ]
            )->withAttribute('bypassCsrfToken', true)
        );

        $this->assertEquals(201, $response->getStatusCode());

        $body = json_decode($response->getBody()->getContents(), true);

        $this->assertEquals('user-erasure-requests', $body['data']['type']);

        $erasureId = $body['data']['id'];
        $this->assertNotNull($erasureId);

        $erasureRequest = ErasureRequest::query()->find($erasureId);

        $this->assertNotNull($erasureRequest);
        $this->assertIsString($erasureRequest->verification_token);
        $this->assertEquals('awaiting_user_confirmation', $erasureRequest->status);
        $this->assertNull($erasureRequest->reason);
        $this->assertNotNull($erasureRequest->created_at);
        $this->assertNull($erasureRequest->user_confirmed_at);
        $this->assertNull($erasureRequest->processed_by);
        $this->assertNull($erasureRequest->processor_comment);
        $this->assertNull($erasureRequest->processed_at);
        $this->assertNull($erasureRequest->processed_mode);

        $notification = Notification::query()->where('user_id', 2)->where('type', 'gdpr_erasure_confirm')->orderBy('id', 'desc')->first();

        $this->assertNotNull($notification);
    }
}
