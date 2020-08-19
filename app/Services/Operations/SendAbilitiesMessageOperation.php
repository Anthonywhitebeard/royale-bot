<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleState;
use App\Services\MessageFormer;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramOtherException;

class SendAbilitiesMessageOperation implements OperationInterface
{
    /**
     * @var TelegramSender
     */
    private TelegramSender $telegram;
    /**
     * @var AbilityBuilder
     */
    private AbilityBuilder $abilityBuilder;

    /**
     * SendMessageOperation constructor.
     * @param TelegramSender $telegram
     * @param AbilityBuilder $abilityBuilder
     */
    public function __construct(TelegramSender $telegram, AbilityBuilder $abilityBuilder)
    {
        $this->telegram = $telegram;
        $this->abilityBuilder = $abilityBuilder;
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
        $text = MessageFormer::formOperationText($params, $battleState);

        $player = $battleState->getAlivePlayer(0)->battlePlayer;
        if (!$player->tg_message_id) {
            $this->telegram->sendChatMessage(
                $text,
                $player->battle->chat->tg_id
            );
            return $battleState;
        }


        $keyboard = $this->abilityBuilder->buildAbilityKeyboard($player);

        $this->telegram->sendKeyboardReplyMessage(
            $player->battle->chat->tg_id,
            $text,
            $player->tg_message_id,
            $keyboard
        );

        return $battleState;
    }
}
