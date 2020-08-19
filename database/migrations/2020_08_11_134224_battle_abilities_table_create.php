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
            $table->integer('battle_id')->unsigned();
            $table->string('ability_name');
            $table->string('slug');
            $table->text('activation_text')->nullable();
            $table->bigInteger('battle_player_id')->unsigned();
            $table->boolean('state');
            $table->smallInteger('charge_last')->nullable();
            $table->smallInteger('last_use_round')->nullable();
            $table->smallInteger('last_use_turn')->nullable();
            $table->smallInteger('turn_cd')->default(0);
            $table->smallInteger('round_cd')->default(0);
            $table->boolean('active');
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
