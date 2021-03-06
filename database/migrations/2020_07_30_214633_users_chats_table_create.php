<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersChatsTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname');
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('chat_id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('chat_id')->references('id')->on('chats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
