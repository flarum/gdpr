<?php

namespace Blomstra\Gdpr\Jobs;

use Flarum\Queue\AbstractJob;

abstract class GdprJob extends AbstractJob
{
    public static ?string $onQueue = null;
}
