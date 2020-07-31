<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BattleStatesTableCteate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('battle_states', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('battle_id')->unsigned();
            $table->foreign('battle_id')->references('id')->on('battles');
            $table->text('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('battle_states');
    }
}
