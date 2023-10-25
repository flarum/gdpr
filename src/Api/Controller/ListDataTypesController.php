<?php

namespace Blomstra\Gdpr\Api\Controller;

use Blomstra\Gdpr\Api\Serializer\DataTypeSerializer;
use Blomstra\Gdpr\DataProcessor;
use Flarum\Api\Controller\AbstractListController;
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
