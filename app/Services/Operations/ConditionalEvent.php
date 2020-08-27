<?php

namespace App\Services\Operations;

use App\Models\BattleModels\BattleClass;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\Turn;
use Telegram\Bot\Api;

class ConditionalEvent extends AbstractStateOperation
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

        $params = explode(';', $params);

        if (count($params) < 2) {
            return $battleState;
        }
        $player = $this->getAlivePlayer($battleState, $target, true);

        $eventName = array_shift($params);
        /** @var Event $event */
        $event = Event::where('slug', $eventName)->first();
        if (!$event) {
            return $battleState;
        }

        foreach ($params as $flag) {
            if (!$player->hasFlag($flag)) {
                return $battleState;
            }
        }
        Turn::doEvent($event, $battleState);
        return $battleState;
    }
}
