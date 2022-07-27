<?php

namespace Blomstra\Gdpr\Events;

use Flarum\User\User;

class Exported
{
    public function __construct(public User $user)
    {}
}
