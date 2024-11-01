<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->dateTime('canceled_at')->nullable();
            $table->unsignedInteger('canceled_by')->nullable();

            $table->foreign('canceled_by')->references('id')->on('users')->nullOnDelete();
        });
    },
    'down' => function (Builder $schema) {
        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->dropForeign(['canceled_by']);
        });

        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->dropColumn('canceled_at', 'canceled_by');
        });
    }
];
