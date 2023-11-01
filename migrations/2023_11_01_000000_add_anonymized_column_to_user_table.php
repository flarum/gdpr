<?php

use Flarum\Database\Migration;

return Migration::addColumns('users', [
    'anonymized' => ['boolean', 'default' => false, 'nullable' => false],
]);
