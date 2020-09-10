<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\MessageFormer;
use App\Services\TelegramSender;
use Telegram\Bot\Exceptions\TelegramOtherException;
use Telegram\Bot\Exceptions\TelegramSDKException;

class SendMessageOperation implements OperationInterface
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
     * @throws TelegramSDKException
     */
    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState {
        try {
            $this->telegram->sendChatMessage(MessageFormer::formOperationText($params, $battleState),
                $battleState->chat->tg_id);

        } catch (TelegramOtherException $e) {
            /** @todo handle to many request exception */
        }

        return $battleState;
    }
}
