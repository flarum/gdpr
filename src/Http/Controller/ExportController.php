<?php

namespace Bokt\Gdpr\Http\Controller;

use Bokt\Gdpr\Exporter;
use Bokt\Gdpr\Models\Export;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Validation\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExportController implements RequestHandlerInterface
{
    protected $zip;

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var User $actor */
        $actor = $request->getAttribute('actor');

        $file = Arr::get($request->getQueryParams(), 'file');

        if (! $actor || !$file) {
            throw new UnauthorizedException;
        }

        $export = Export::byFile($file);

        if ($export) {
            return (new Exporter)->getZip($export);
        }

        throw new FileNotFoundException;
    }
}
