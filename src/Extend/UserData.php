<?php

namespace Bokt\Gdpr\Extend;

use Bokt\Gdpr\Exporter;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class UserData implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        // Nothing here 👨‍💻
    }

    public function addType(string $type)
    {
        Exporter::addType($type);
    }
}
