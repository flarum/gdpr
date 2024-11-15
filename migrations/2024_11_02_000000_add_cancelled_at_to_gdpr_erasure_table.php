<?php

/*
 * This file is part of Flarum
 *
 * Copyright (c) Flarum Foundation
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

return Migration::addColumns('gdpr_erasure', [
    'cancelled_at' => ['datetime', 'nullable' => true],
]);
