<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\BattlePlayer;
use App\Models\Chat;
use App\Models\Player;
use App\Services\Keyboard;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class RegistrationInBattle implements EventHandler
{
    /** @var TelegramSender $telegram */
    private $telegram;

    /**
     * StartBattle constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Update $update
     * @param Chat $chat
     * @param Player $player
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Update $update, Chat $chat, Player $player): void
    {
        $message = $update->getMessage();
        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', '<>', Battle::BATTLE_STATE_FINISHED)
            ->first();

        if (!$lastBattle) {
            $this->telegram->sendMessage('Никакой битвы не планируется, но ее можно создать', $message);

            return;
        }

        if ($lastBattle->state === Battle::BATTLE_STATE_IN_PROCESS) {
            $this->telegram->sendMessage('А все уже, раньше надо было', $message);

            return;
        }

        $oldBattlePlayer = BattlePlayer::where('battle_id', $lastBattle->id)
            ->where('player_id', $player->id)->first();

        if ($oldBattlePlayer) {
            $this->telegram->sendMessage('Двічі в одну річку не ввійдеш', $message);

            return;
        }

        /** @var BattlePlayer $newBattlePlayer */
        $newBattlePlayer = $lastBattle->battlePlayers()->make([
            'user_name' => $message->from->playername ?? $message->from->firstName,
            'tg_message_id' => $message->messageId,
        ]);

        $newBattlePlayer->player()->associate($player)->save();
        $this->telegram->sendMessage('Добро пожаловать в метрополитен', $message);
        $this->telegram->sendKeyboardMessage(
            $chat->tg_id,
            'Выберитеваш класс',
            $message->messageId,
            Keyboard::battleClasses($chat),
        );
    }

    private function genereteClassKeybord()
    {

    }
}
