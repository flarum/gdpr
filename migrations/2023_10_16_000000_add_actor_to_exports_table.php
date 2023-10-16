<?php

use Flarum\Database\Migration;

return Migration::addColumns(
    'gdpr_exports',
    [
        'actor_id' => ['integer', 'unsigned' => true, 'nullable' => true],
    ]);
