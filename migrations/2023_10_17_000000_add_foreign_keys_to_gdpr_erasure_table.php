<?php

/*
 * This file is part of blomstra/flarum-gdpr
 *
 * Copyright (c) 2021 Blomstra Ltd
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        // Handle orphaned rows: set user_id to null
        $schema->getConnection()->table('gdpr_erasure')->whereNotIn('user_id', function ($query) {
            $query->select('id')->from('users');
        })->update(['user_id' => null]);

        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->dropUnique(['user_id']);
            $table->integer('user_id')->unsigned()->nullable()->unique()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('gdpr_erasure', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropUnique(['user_id']);
            $table->integer('user_id')->unsigned()->unique()->change();
        });
    },
];
