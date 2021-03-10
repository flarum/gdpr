<?php

namespace Blomstra\Gdpr\Command;

use Blomstra\Gdpr\Models\DeletionRequest;
use Blomstra\Gdpr\Notifications\ConfirmDeletionBlueprint;
use Flarum\Notification\NotificationSyncer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class RequestDeletionHandler
{
    protected $notifications;

    public function __construct(NotificationSyncer $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @param RequestDeletion $command
     * @return void
     */
    public function handle(RequestDeletion $command)
    {
        $actor = $command->actor;

        $reason = Arr::get($command->data, 'attributes.reason');

        $token = Str::random(40);

        DeletionRequest::unguard();

        $deletionRequest = DeletionRequest::firstOrNew([
            'user_id' => $actor->id,
        ]);

        $deletionRequest->user_id = $actor->id;
        $deletionRequest->status = 'sent';
        $deletionRequest->reason = empty($reason) ? null : $reason;
        $deletionRequest->verification_token = $token;
        $deletionRequest->created_at = Carbon::now();

        $deletionRequest->save();

        $this->notifications->sync(new ConfirmDeletionBlueprint($deletionRequest), [$actor]);

        return $deletionRequest;
    }
}
