<?php

/*
 * This file is part of Flarum.
 *
 * For detailed copyright and license information, please view the
 * LICENSE file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Api\Controller;

use Flarum\Gdpr\DataProcessor;
use Flarum\Http\RequestUtil;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListUserColumnsDataController implements RequestHandlerInterface
{
    public function __construct(protected DataProcessor $processor)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        RequestUtil::getActor($request)->assertAdmin();

        $removableColumns = $this->processor->removableUserColumns();
        $allColumns = $this->processor->allUserColumns();

        return new JsonResponse([
            'data' => [
                'removableColumns' => $removableColumns,
                'allColumns'       => $allColumns,
            ],
        ]);
    }
}
