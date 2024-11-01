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

namespace Flarum\Gdpr\Console;

use Flarum\Gdpr\Exporter;
use Flarum\Gdpr\Models\Export;
use Illuminate\Console\Command;

class DestroyExportsCommand extends Command
{
    protected $signature = 'gdpr:destroy-exports';
    protected $description = 'Deletes exported data sets.';

    public function handle(Exporter $exporter): void
    {
        Export::destroyable()
            ->each(function (Export $export) use ($exporter) {
                $exporter->destroy($export);
            });
    }
}
