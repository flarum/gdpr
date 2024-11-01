<?php

/*
 * This file is part of Flarum
 *
 * Copyright (c) 2021 Blomstra Ltd
 * Copyright (c) 2024 Flarum Foundation
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Http\Controller;

use Flarum\Gdpr\Models\Export;
use Flarum\Gdpr\StorageManager;
use Flarum\Http\RequestUtil;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExportController implements RequestHandlerInterface
{
    public function __construct(protected StorageManager $storageManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // @TODO: any user can download any export file if guessed, this should be restricted

        $actor = RequestUtil::getActor($request);

        $file = Arr::get($request->getQueryParams(), 'file');

        $export = Export::byFile($file);

        if ($export) {
            return new Response(
                $this->storageManager->getStoredExport($export),
                200,
                [
                    'Content-Type'        => 'application/zip',
                    'Content-Length'      => $this->storageManager->getStoredExportSize($export),
                    'Content-Disposition' => 'attachment; filename="data-export-'.$export->user->username.'-'.$export->created_at->toIso8601String().'.zip"',
                ]
            );
        }

        throw new FileNotFoundException();
    }
}
