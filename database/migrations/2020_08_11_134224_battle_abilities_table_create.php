<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BattleAbilitiesTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ability_id')->unsigned()->nullable();
            $table->bigInteger('battle_player_id')->unsigned();
            $table->boolean('state');
            $table->timestamps();

            $table->foreign('ability_id')->references('id')->on('abilities');
            $table->foreign('battle_player_id')->references('id')->on('battles_players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('battle_abilities');
    }
}
