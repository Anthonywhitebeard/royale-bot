<?php


namespace App\Services\BattleProcess;


class BattleConditions
{

    public static function getAlivePlayersConditions(BattleState $battleState): array
    {
        $alivePlayersCount = count($battleState->getAlivePlayers());

        $conditions = [];
        for ($i = 1; $i <= $alivePlayersCount; $i++) {
            $conditions[] = $i . "_players";
        }
        if ($alivePlayersCount === count($battleState->players)) {
            $conditions[] = 'all_players';
        }
        return $conditions;
    }
}
