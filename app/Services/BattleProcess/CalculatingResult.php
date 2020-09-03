<?php

declare(strict_types=1);

namespace App\Services\BattleProcess;

use App\Models\BattleResult;

class CalculatingResult
{
    public function endGameCalculations(BattleState $state): void
    {
        $alivePlayers = $state->getAlivePlayers();
        $battlePlayer = $alivePlayers[0];

        if ($battlePlayer) {
            $this->markWinner($battlePlayer);
        }

        $this->logBattleResult($state);
    }

    /**
     * @param PlayerState $playerState
     */
    private function markWinner(PlayerState $playerState): void
    {
        $battlePlayer = $playerState->battlePlayer;
        $battlePlayer->refresh();
        $battlePlayer->place = 1;
        $battlePlayer->save();
    }

    /**
     * @param BattleState $state
     */
    private function logBattleResult(BattleState $state): void
    {
        BattleResult::create([
            'round_last' => $state->round,
            'turn_last' => $state->turn,
            'battle_id' => $state->battleId,
        ]);
    }
}
