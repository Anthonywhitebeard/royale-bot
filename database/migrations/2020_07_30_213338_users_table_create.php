<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('tg_id')->nullable();
            $table->integer('mmr')->default(\App\Models\Player::DEFAULT_MMR);
            $table->integer('rp')->default(0);
            $table->integer('skill')->default(1000);
            $table->boolean('promo_lost')->default(0);
            $table->boolean('bot')->default(0);
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
        Schema::drop('players');
    }
}
