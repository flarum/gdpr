<?php

namespace Blomstra\Gdpr\Events;

use Flarum\User\User;

class Exporting
{
    public function __construct(public User $user)
    {}
}
