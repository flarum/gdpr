<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Flarum\Database\Migration;

// HINT: you might want to use a `Flarum\Database\Migration` helper method for simplicity!
// See https://docs.flarum.org/extend/data.html#migrations to learn more about migrations.

return Migration::addSettings([
    'blomstra-gdpr.allow-anonymization' => true,
    'blomstra-gdpr.allow-deletion'      => true,
    'blomstra-gdpr.default-erasure'     => 'deletion',
]);
