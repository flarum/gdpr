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

use Blomstra\Gdpr\Events\Exported;
use Blomstra\Gdpr\Events\Exporting;
use Blomstra\Gdpr\Exporter;
use Blomstra\Gdpr\Models\Export;
use Blomstra\Gdpr\Notifications\ExportAvailableBlueprint;
use Flarum\Notification\NotificationSyncer;
use Flarum\Queue\AbstractJob;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;

class ExportJob extends AbstractJob
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(Exporter $exporter, NotificationSyncer $notifications, Dispatcher $events)
    {
        $events->dispatch(new Exporting($this->user));

        $export = $exporter->export($this->user);

        $this->notify($export, $notifications);

        $events->dispatch(new Exported($this->user));
    }

    public function notify(Export $export, NotificationSyncer $notifications)
    {
        $notifications->sync(
            new ExportAvailableBlueprint($export),
            [$export->user]
        );
    }
}
