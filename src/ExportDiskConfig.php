<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

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
