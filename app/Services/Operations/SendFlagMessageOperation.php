<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\MessageFormer;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramOtherException;

class SendFlagMessageOperation implements OperationInterface
{
    /**
     * @var TelegramSender
     */
    private TelegramSender $telegram;

    /**
     * SendMessageOperation constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
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
    ): BattleState
    {
        $target = $battleState->getAlivePlayer($target);
        $params = explode(';', $params);
        if ($params<2) {
            return $battleState;
        }
        $message = array_shift($params);
        foreach ($params as $flag) {
            if (strrpos($flag, '!') === 0) {
                $flag = ltrim($flag, '!');
                if ($target->hasFlag($flag)) {
                    return $battleState;
                }
            } else {
                if (!$target->hasFlag($flag)) {
                    return $battleState;
                }
            }
        }
        $this->telegram->sendChatMessage(MessageFormer::formOperationText($message, $battleState),
            $battleState->chat->tg_id);
        return $battleState;
    }
}
