<?php

/*
 * This file is part of Flarum
 *
 * Copyright (c) 2021 Blomstra Ltd
 * Copyright (c) 2024 Flarum Foundation
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Events;

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
