<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BotsTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('battle_class_id')->unsigned()->nullable();
            $table->bigInteger('player_id')->unsigned();
            $table->smallInteger('deviance')->default(0);
            $table->boolean('default_events')->default(1);
            $table->boolean('active');
            $table->timestamps();

            $table->foreign('battle_class_id')->references('id')->on('battle_classes');
            $table->foreign('player_id')->references('id')->on('players');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bots');
    }
}
