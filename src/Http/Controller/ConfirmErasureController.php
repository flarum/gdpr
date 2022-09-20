<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Http\Controller;

use Blomstra\Gdpr\Models\ErasureRequest;
use Carbon\Carbon;
use Flarum\Foundation\ValidationException;
use Flarum\Http\SessionAuthenticator;
use Flarum\Http\UrlGenerator;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

class ConfirmErasureController implements RequestHandlerInterface
{
    /**
     * @var UrlGenerator
     */
    protected $url;

    /**
     * @var SessionAuthenticator
     */
    protected $authenticator;

    /**
     * @param UrlGenerator $url
     */
    public function __construct(UrlGenerator $url, SessionAuthenticator $authenticator)
    {
        $this->url = $url;
        $this->authenticator = $authenticator;
    }

    /**
     * @param Request $request
     *
     * @return ResponseInterface
     */
    public function handle(Request $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $token = Arr::get($request->getQueryParams(), 'token');

        /** @var ErasureRequest $erasureRequest */
        $erasureRequest = ErasureRequest::query()
            ->where('verification_token', $token)
            ->firstOrFail();

        if ($erasureRequest->user->is($actor)) {
            throw new ValidationException(['user' => 'Erase requests cannot be confirmed by different users.']);
        }

        $erasureRequest->user_confirmed_at = Carbon::now();
        $erasureRequest->status = 'user_confirmed';
        $erasureRequest->save();

        return new RedirectResponse($this->url->to('forum')->base().'?erasureRequestConfirmed=1');
    }
}
