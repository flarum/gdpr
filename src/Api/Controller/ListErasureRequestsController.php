<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api\Controller;

use Flarum\Api\Controller\AbstractListController;
use Flarum\Gdpr\Api\Serializer\RequestErasureSerializer;
use Flarum\Gdpr\Models\ErasureRequest;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListErasureRequestsController extends AbstractListController
{
    public $serializer = RequestErasureSerializer::class;

    public $include = [
        'user',
    ];

    protected function data(ServerRequestInterface $request, Document $document)
    {
        $actor = RequestUtil::getActor($request);

        $actor->assertCan('processErasure');

        return ErasureRequest::whereVisibleTo($actor)
            ->where('status', ErasureRequest::STATUS_USER_CONFIRMED)
            ->get();
    }
}
