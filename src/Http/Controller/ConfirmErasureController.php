<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Http\Controller;

use Blomstra\Gdpr\Models\ErasureRequest;
use Carbon\Carbon;
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
     * @return ResponseInterface
     */
    public function handle(Request $request): ResponseInterface
    {
        $actor = $request->getAttribute('actor');
        $token = Arr::get($request->getQueryParams(), 'token');

        $erasureRequest = ErasureRequest::where('verification_token', $token)->first();

        $erasureRequest->user_confirmed_at = Carbon::now();
        $erasureRequest->status = 'user_confirmed';
        $erasureRequest->save();

        $session = $request->getAttribute('session');
        $this->authenticator->logIn($session, $erasureRequest->user_id);

        return new RedirectResponse($this->url->to('forum')->base().'?erasureRequestConfirmed=1');
    }
}
