<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Console;

use Illuminate\Console\Scheduling\Event;

class DailySchedule
{
    public function __invoke(Event $event): void
    {
        $event->daily()->withoutOverlapping();
    }
}
