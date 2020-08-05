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

    /**
     * SendMessageOperation constructor.
     * @param Api $telegram
     */
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param BattleState $battleState
     * @param string $params
     * @param string $target
     * @return BattleState
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        $this->telegram->sendMessage([
            'chat_id' => $battleState->chat->tg_id,
            'text' => $this->parseMessage($params),
        ]);

        return $battleState;
    }

    /**
     * @param string $params
     * @return string
     */
    private function parseMessage(string $params): string
    {
        return $params;
//        $params = explode(';', $params);
//        return printf(array_shift(explode($params)), $params);
    }
}
