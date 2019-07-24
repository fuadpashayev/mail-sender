<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendersTable extends Migration
{

    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->mediumText('mail_list');
            $table->integer('week_day');
            $table->string('hour');
            $table->string('subject');
            $table->mediumText('content');
            $table->boolean('sent')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('senders');
    }
}
