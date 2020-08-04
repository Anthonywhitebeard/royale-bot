<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class SetDMGOperation implements OperationInterface
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
    public function operate(BattleState $battleState, string $params): void
    {
        $this->telegram->sendMessage([
            'chat_id' => $battleState->chatId,
            'message' => $this->parseMessage($params),
        ]);
    }

    //TODO:parse message
    private function parseMessage(string $params)
    {
        return 'SetDMG Operation: ' . $params;
    }
}
