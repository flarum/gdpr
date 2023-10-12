<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Providers;

use Blomstra\Gdpr\Exporter;
use Flarum\Foundation\AbstractServiceProvider;
use Illuminate\Contracts\Filesystem\Filesystem;

class GdprProvider extends AbstractServiceProvider
{
    public function boot()
    {
        // $this->container
        //     ->when(Exporter::class)
        //     ->needs(Filesystem::class)
        //     ->give(function () {
        //         return $this->container->make('filesystem')->disk('gdpr-export');
        //     });
    }
}
