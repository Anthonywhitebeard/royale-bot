<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class ModifyDMGOperation extends AbstractStateOperation implements OperationInterface
{
    /**
     * @var Api
     */
    private Api $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    //TODO: add operation
    public function operate(BattleState $battleState, array $activePlayers, string $params): BattleState
    {
        $this->telegram->sendMessage([
            'chat_id' => $battleState->tgId,
            'text' => $this->parseMessage($params),
        ]);
    }

    //TODO:parse message
    private function parseMessage(string $params)
    {
        return 'ModifyDMG Operation: ' . $params;
    }
}
