<?php

use Flarum\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return Migration::createTable(
    'gdpr_exports',
    function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id')->unsigned()->nullable();
        $table->string('file')->nullable();
        $table->dateTime('created_at');
        $table->dateTime('destroys_at');
    }
);
