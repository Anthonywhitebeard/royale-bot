<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\MessageFormer;
use App\Services\TelegramSender;

class UpdateStateInChatOperation extends AbstractStateOperation
{
    private const STATE_TEXT_TEMPLATE = "``` %s (%s)" . PHP_EOL . "     HP: %s, DMG: %s```" . PHP_EOL;

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
        $text = __('battle.turn_message') . $battleState->turn  .'. ' . __('battle.state_message_text') . PHP_EOL;

        foreach ($battleState->players as $player) {
            if ($player->isAlive()) {
                $text .= $this->formatState($player);
            }
        }

        if ($battleState->stateMessageId) {
            $this->telegram->deleteMessage($battleState->chat->tg_id, $battleState->stateMessageId);
        }
        $stateMessage = $this->telegram->sendMarkdownMessage($text, $battleState->chat->tg_id);

        $battleState->stateMessageId = $stateMessage->messageId;
        return $battleState;
    }

    /**
     * @param PlayerState $player
     * @return string
     */
    private function formatState(PlayerState $player): string
    {
        return sprintf(self::STATE_TEXT_TEMPLATE,
            $player->battlePlayer->user_name,
            $player->className,
            $player->hp,
            $player->dmg
        );
    }
}
