<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Contracts;

use Flarum\User\User;
use ZipArchive;

interface DataType
{
    public function __construct(User $user);

    public function export(ZipArchive $zip);
}
