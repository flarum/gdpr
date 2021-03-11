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
use Flarum\Http\UrlGenerator;
use Flarum\User\Exception\PermissionDeniedException;
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
     * @param UrlGenerator $url
     */
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
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

        if ($actor->id !== $erasureRequest->user_id) {
            throw new PermissionDeniedException();
        }

        $erasureRequest->user_confirmed_at = Carbon::now();
        $erasureRequest->status = 'confirmed';
        $erasureRequest->save();

        return new RedirectResponse($this->url->to('forum')->base());
    }
}
