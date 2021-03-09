<?php

namespace Blomstra\Gdpr\Providers;

use Blomstra\Gdpr\Exporter;
use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Foundation\Paths;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;

class GdprProvider extends AbstractServiceProvider
{
    public function boot()
    {
        /** @var Paths $paths */
        $paths = $this->app->make(Paths::class);
        /** @var Repository $config */
        $config = $this->app->get('config');

        $disks = $config->get('filesystems.disks', []);
        $disks['gdpr-export'] = [
            'driver' => 'local',
            'root'   => $paths->storage.'/gdpr-exports'
        ];
        $config->set('filesystems.disks', $disks);

        $this->app
            ->when(Exporter::class)
            ->needs(Filesystem::class)
            ->give(function () {
                return $this->app->make('filesystem')->disk('gdpr-export');
            });
    }
}
