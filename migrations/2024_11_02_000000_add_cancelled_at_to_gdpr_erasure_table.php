<?php

use Flarum\Database\Migration;

return Migration::addColumns('gdpr_erasure', [
    'cancelled_at' => ['datetime', 'nullable' => true]
]);
