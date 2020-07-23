<?php

namespace Bokt\Gdpr\Http\Controller;

use Bokt\Gdpr\Exporter;
use Flarum\User\User;
use Illuminate\Validation\UnauthorizedException;
use Laminas\Diactoros\Response;
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

        if (! $actor) {
            throw new UnauthorizedException;
        }

        $exporter = new Exporter;
        $zip = $this->zip = $exporter->export($actor);

        return new Response(
            fopen($zip, 'r'),
            200,
            [
                'Content-Type' => 'application/zip',
                'Content-Length' => filesize($zip),
                'Content-Disposition' => 'attachment; filename="gdpr-data-' . $actor->username . '.zip"'
            ]
        );
    }

    public function __destruct()
    {
        if ($this->zip) {
            unlink($this->zip);
        }
    }
}
