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

use Blomstra\Gdpr\Exporter;
use Blomstra\Gdpr\Models\Export;
use Blomstra\Gdpr\Notifications\ExportAvailableBlueprint;
use Flarum\Notification\NotificationSyncer;
use Flarum\Queue\AbstractJob;
use Flarum\User\User;

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

    public function handle(Exporter $exporter, NotificationSyncer $notifications)
    {
        $export = $exporter->export($this->user);

        $this->notify($export, $notifications);
    }

    public function notify(Export $export, NotificationSyncer $notifications)
    {
        // $notifications->onePerUser(function () use ($export, $notifications) {
        $notifications->sync(
            new ExportAvailableBlueprint($export),
            [$export->user]
        );
        // });
    }
}
