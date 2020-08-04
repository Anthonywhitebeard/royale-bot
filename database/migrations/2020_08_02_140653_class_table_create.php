<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClassTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('flag');
            $table->smallInteger('deviance')->default(0);
            $table->bigInteger('event_id')->unsigned();
            $table->boolean('active')->default(1);
            $table->foreign('event_id')->references('id')->on('events');
        });

        Schema::table('battles_players', function (Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('battle_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('battles_players', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
        });
        Schema::drop('battle_classes');
    }
}
