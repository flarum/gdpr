<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('gdpr_exports', function (Blueprint $table) {
            $table->foreign('actor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('gdpr_exports', function (Blueprint $table) {
            $table->dropForeign(['actor_id']);
            $table->dropForeign(['user_id']);
        });
    }
];
