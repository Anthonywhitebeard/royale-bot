<?php


namespace App\Services\EventHandlers;

use App\Models\Battle;
use App\Models\BattlesUsers;
use App\Models\Chat;
use App\Models\User;
use App\Services\TelegramSender;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

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
     * @param Message $message
     * @param Chat $chat
     * @param User $user
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Message $message, Chat $chat, User $user): void
    {
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

        $oldBattleUser = BattlesUsers::where('battle_id', $lastBattle->id)
            ->where('user_id', $user->id)->first();

        if ($oldBattleUser) {
            $this->telegram->sendMessage('Двічі в одну річку не ввійдеш', $message);

            return;
        }

        /** @var BattlesUsers $newBattleUser */
        $newBattleUser = $lastBattle->battleUsers()->make([
            'start_mmr' => $user->mmr,
            'start_rp' => $user->rp,
            'start_skill' => $user->skill,
            'user_name' => $message->from->username ?? $message->from->firstName,
        ]);

        $newBattleUser->user()->associate($user)->save();
        $this->telegram->sendMessage('Добро пожаловать в метрополитен', $message);
    }
}
