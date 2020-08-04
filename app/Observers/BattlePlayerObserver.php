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
        if ($battlePlayer->start_mmr === null) {
            $battlePlayer->setAttribute('start_mmr', $battlePlayer->player->mmr);
        }

        if ($battlePlayer->start_rp === null) {
            $battlePlayer->setAttribute('start_rp', $battlePlayer->player->rp);
        }
        if ($battlePlayer->start_skill === null) {
            $battlePlayer->setAttribute('start_skill', $battlePlayer->player->skill);
        }
    }
}
