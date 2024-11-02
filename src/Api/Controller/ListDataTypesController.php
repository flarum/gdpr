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
use Flarum\Gdpr\Api\Serializer\DataTypeSerializer;
use Flarum\Gdpr\DataProcessor;
use Flarum\Http\RequestUtil;
use Psr\Http\Message\ServerRequestInterface;
use Tobscure\JsonApi\Document;

class ListDataTypesController extends AbstractListController
{
    public function __construct(protected DataProcessor $processor)
    {
    }

    public $serializer = DataTypeSerializer::class;

    protected function data(ServerRequestInterface $request, Document $document)
    {
        RequestUtil::getActor($request)->assertAdmin();

        $types = $this->processor->types();

        return array_map(function ($class, $extension) {
            return (object) ['class' => $class, 'extension' => $extension];
        }, array_keys($types), $types);
    }
}
