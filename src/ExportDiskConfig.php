<?php

namespace Blomstra\Gdpr;

use Flarum\Foundation\Paths;
use Flarum\Http\UrlGenerator;

class ExportDiskConfig
{
    public function __invoke(Paths $paths, UrlGenerator $url): array
    {
        return [
            'root'   => "$paths->storage/gdpr-exports",
        ];
    }
}
