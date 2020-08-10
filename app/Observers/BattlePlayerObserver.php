<?php

namespace App\Observers;


use App\Models\BattlePlayer;

class BattlePlayerObserver
{
    /**
     * Handle the battle user "created" event.
     *
     * @param BattlePlayer $battlePlayer
     * @return void
     */
    public function saving(BattlePlayer $battlePlayer)
    {
        if (!isset($battlePlayer->start_mmr)) {
            $battlePlayer->setAttribute('start_mmr', $battlePlayer->player->mmr);
        }

        if (!isset($battlePlayer->start_rp)) {
            $battlePlayer->setAttribute('start_rp', $battlePlayer->player->rp);
        }
        if (!isset($battlePlayer->start_skill)) {
            $battlePlayer->setAttribute('start_skill', $battlePlayer->player->skill);
        }
    }
}
