<?php

namespace Blomstra\Gdpr\Data;

use Blomstra\Gdpr\Contracts\DataType;
use Flarum\User\User;

abstract class Type implements DataType
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
