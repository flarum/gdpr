<?php

namespace Bokt\Gdpr\Extend;

use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class Provider implements ExtenderInterface
{
    protected $providers = [];

    public function __construct(string $provider = null)
    {
        if ($provider) $this->providers[] = $provider;
    }

    public function extend(Container $container, Extension $extension = null)
    {
        $app = $container->get('flarum');

        foreach($this->providers as $provider) {
            $app->register($provider);
        }
    }

    public function add(string $provider)
    {
        $this->providers[]  = $provider;

        return $this;
    }
}
