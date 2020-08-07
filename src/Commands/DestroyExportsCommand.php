<?php

namespace Bokt\Gdpr\Commands;

use Bokt\Gdpr\Exporter;
use Bokt\Gdpr\Models\Export;
use Illuminate\Console\Command;

class DestroyExportsCommand extends Command
{
    protected $signature = 'gdpr:destroy-exports';
    protected $description = 'Deletes exported data sets.';

    public function handle(Exporter $exporter)
    {
        Export::destroyable()
            ->each(function (Export $export) use ($exporter) {
                $exporter->destroy($export);
            });
    }
}
