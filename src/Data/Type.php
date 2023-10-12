<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Data;

use Blomstra\Gdpr\Contracts\DataType;
use Flarum\User\User;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Contracts\Filesystem\Filesystem;

abstract class Type implements DataType
{
    public function __construct(protected User $user, protected Factory $factory)
    {
    }

    public function getDisk(?string $name): Filesystem
    {
        return $this->factory->disk($name);
    }
}
