<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AbilityTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abilities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('activation_text')->nullable();
            $table->integer('battle_class_id')->unsigned()->nullable();
            $table->bigInteger('event_id')->unsigned();
            $table->smallInteger('charges')->unsigned()->nullable();
            $table->smallInteger('turn_cd')->default(0);
            $table->smallInteger('round_cd')->default(0);
            $table->boolean('active');
            $table->timestamps();


            $table->foreign('battle_class_id')->references('id')->on('battle_classes');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('abilities');
    }
}
