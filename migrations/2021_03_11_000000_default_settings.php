<?php

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Builder;

// HINT: you might want to use a `Flarum\Database\Migration` helper method for simplicity!
// See https://docs.flarum.org/extend/data.html#migrations to learn more about migrations.

return Migration::addSettings([
    'blomstra-gdpr.allow-anonymization' => true,
    'blomstra-gdpr.allow-deletion' => true,
    'blomstra-gdpr.default-erasure' => 'deletion'
]);
