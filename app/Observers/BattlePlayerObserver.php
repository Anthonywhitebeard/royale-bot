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

    /**
     * Handle the battle user "updated" event.
     *
     * @param BattlePlayer $battlePlayer
     * @return void
     */
    public function updated(BattlePlayer $battlePlayer)
    {
        //
    }

    /**
     * Handle the battle user "deleted" event.
     *
     * @param BattlePlayer $battlePlayer
     * @return void
     */
    public function deleted(BattlePlayer $battlePlayer)
    {
        //
    }

    /**
     * Handle the battle user "restored" event.
     *
     * @param BattlePlayer $battlePlayer
     * @return void
     */
    public function restored(BattlePlayer $battlePlayer)
    {
        //
    }

    /**
     * Handle the battle user "force deleted" event.
     *
     * @param BattlePlayer $battlePlayer
     * @return void
     */
    public function forceDeleted(BattlePlayer $battlePlayer)
    {
        //
    }
}
