<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Flarum\Gdpr\Events;

use Flarum\Gdpr\Models\ErasureRequest;

class Erasing
{
    public function __construct(
        public ErasureRequest $user,
    ) {
    }
}
