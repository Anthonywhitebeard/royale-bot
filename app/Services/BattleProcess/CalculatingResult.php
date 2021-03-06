<?php

declare(strict_types=1);

namespace App\Services\BattleProcess;

use App\Models\BattlePlayer;
use App\Models\BattleResult;
use Illuminate\Support\Arr;

class CalculatingResult
{
    public function endGameCalculations(BattleState $state): void
    {
        $alivePlayers = $state->getAlivePlayers();
        $battlePlayer = Arr::get($alivePlayers, 0);

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
        $battlePlayer = BattlePlayer::whereKey($playerState->battlePlayer->id)->first();

        if (!$battlePlayer) {
            return;
        }

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
