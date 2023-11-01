<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\Gdpr\Events;

use Flarum\User\User;

class Erased
{
    public function __construct(
        public string $username,
        public string $email,
        public string $mode,
        public User $user
    ) {
    }
}
