<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BattleResultsTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('battle_id')->unsigned();
            $table->smallInteger('round_last');
            $table->smallInteger('turn_last');
            $table->timestamps();

            $table->foreign('battle_id')->references('id')->on('battles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('battle_results');
    }
}
