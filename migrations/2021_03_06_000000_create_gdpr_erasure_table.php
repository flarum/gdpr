<?php

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return Migration::createTable(
    'gdpr_erasure',
    function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned()->unique();
        $table->string('verification_token');
        $table->string('status')->nullable();
        $table->text('reason')->nullable();
        $table->dateTime('created_at');
        $table->dateTime('user_confirmed_at')->nullable();
        $table->integer('processed_by')->unsigned()->nullable();
        $table->text('processor_comment')->nullable();
        $table->dateTime('processed_at')->nullable();
        $table->string('processed_mode')->nullable();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
        $table->foreign('processed_by')->references('id')->on('users')->onDelete('no action');
    }
);
