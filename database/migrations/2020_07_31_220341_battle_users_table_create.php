<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BattleUsersTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('battle_id')->unsigned();
            $table->foreign('battle_id')->references('id')->on('battles');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name');
            $table->integer('class_id')->unsigned()->nullable();
            $table->integer('start_mmr');
            $table->integer('start_rp');
            $table->integer('start_skill');
            $table->integer('end_mmr')->nullable();
            $table->integer('end_rp')->nullable();
            $table->integer('end_skill')->nullable();
            $table->smallInteger('place')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('battles_users');
    }
}
