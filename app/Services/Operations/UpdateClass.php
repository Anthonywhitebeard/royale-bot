<?php

namespace App\Services\Operations;

use App\Models\BattleModels\BattleClass;
use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class UpdateClass extends AbstractStateOperation
{
    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @return BattleState
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState
    {
        $player = $this->getAlivePlayer($battleState, $target);

        /** @var BattleClass $class */
        $class = BattleClass::where('flag', $params)->first();
        if (!$class) {
            return $battleState;
        }
        if ($player->battlePlayer->class_id === $class->id) {
            return $battleState;
        }
        $player->battlePlayer->battleAbilities()->update(['active' => 0]);
        $player->updateClass($class);

        AbilityBuilder::fillBattleAbilities($player->battlePlayer, $class);

        return $battleState;
    }
}
