<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Extend;

use Blomstra\Gdpr\DataProcessor;
use Flarum\Extend\ExtenderInterface;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

class UserData implements ExtenderInterface
{
    public function extend(Container $container, Extension $extension = null)
    {
        // ..
    }

    public function addType(string $type)
    {
        DataProcessor::addType($type);
    }
}
