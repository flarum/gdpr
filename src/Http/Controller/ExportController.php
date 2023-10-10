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

use Blomstra\Gdpr\Exporter;
use Blomstra\Gdpr\Models\Export;
use Flarum\Http\RequestUtil;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Validation\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExportController implements RequestHandlerInterface
{
    public function __construct(protected Exporter $exporter)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $actor = RequestUtil::getActor($request);

        $file = Arr::get($request->getQueryParams(), 'file');

        if (!$actor || !$file) {
            throw new UnauthorizedException();
        }

        $export = Export::byFile($file);

        if ($export) {
            return $this->exporter->getZip($export);
        }

        throw new FileNotFoundException();
    }
}
