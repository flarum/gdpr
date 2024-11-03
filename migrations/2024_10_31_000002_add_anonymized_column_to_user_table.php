<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        if (!$schema->hasColumn('users', 'anonymized')) {
            $schema->table('users', function (Blueprint $table) {
                $table->boolean('anonymized')->default(false)->nullable(false);
            });
        }
    },
    'down' => function (Builder $schema) {
        if ($schema->hasColumn('users', 'anonymized')) {
            $schema->table('users', function (Blueprint $table) {
                $table->dropColumn('anonymized');
            });
        }
    },
];
