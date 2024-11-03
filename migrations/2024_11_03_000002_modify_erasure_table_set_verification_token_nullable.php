<?php

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->string('verification_token')->nullable()->change();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->string('verification_token')->nullable(false)->change();
        });
    },
];
