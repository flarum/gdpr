<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Jobs;

use Flarum\Queue\AbstractJob;

abstract class GdprJob extends AbstractJob
{
    public static ?string $onQueue = null;
}
