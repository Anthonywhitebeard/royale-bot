<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use Telegram\Bot\Api;

class SendMessageOperation implements OperationInterface
{

    /**
     * @var Api
     */
    private Api $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function operate(
        BattleState $battleState,
        array $activePlayers,
        string $params,
        string $target
    ): BattleState {
        $this->telegram->sendMessage([
            'chat_id' => $battleState->tgId,
            'text' => $this->parseMessage($params),
        ]);

        return $battleState;
    }

    private function parseMessage(string $params): string
    {
        return $params;
//        $params = explode(';', $params);
//        return printf(array_shift(explode($params)), $params);
    }
}
