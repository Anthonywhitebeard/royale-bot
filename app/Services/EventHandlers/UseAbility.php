<?php

declare(strict_types=1);

namespace App\Services\EventHandlers;

use App\Jobs\BattleDriver;
use App\Jobs\BattleDriver\BattleStart;
use App\Jobs\MessageParser;
use App\Models\Battle;
use App\Models\BattleAbility;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Bot;
use App\Models\Chat;
use App\Models\Player;
use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\Keyboard;
use App\Services\MessageFormer;
use App\Services\Operations\SendAbilitiesMessageOperation;
use App\Services\TelegramSender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class UseAbility implements EventHandler
{
    /** @var TelegramSender $telegram */
    private TelegramSender $telegram;

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
        /** @var Battle $battle */
        $battle = Battle::where('chat_id', $chat->id)
            ->where('state', Battle::BATTLE_STATE_IN_PROCESS)
            ->first();
        if (!$battle) {
            return;
        }

        /** @var BattlePlayer $battlePlayer */
        $battlePlayer = BattlePlayer::where('player_id', $player->id)
            ->where('battle_id', $battle->id)
            ->first();
        if (!$battlePlayer || !$battlePlayer->tg_message_id) {
            return;
        }
        /** @var BattleAbility $battleAbility */
        $battleAbility = $battlePlayer->battleAbilities()->where('ability_name', $message->text)->first();
        if (!$battleAbility) {
            return;
        }

        $state = json_decode($battle->battleState->state, true);
        /** @var BattleState $state */
        $state = app()->make(BattleState::class, $state);


        $playerState = $state->getPlayerState($battlePlayer);
        if ($playerState->hasFlag(PlayerState::FLAG_DEAD)) {
            $this->telegram->sendKeyboardReplyMessage(
                $battle->chat->tg_id,
                __('battle.ability_refuse_dead'),
                (string)$message->messageId,
                Keyboard::makeAbilityKeyboard([]),
            );
            return;
        }
        if (!AbilityBuilder::isAbilityAvailable($battleAbility)) {
            return;
        }
        $battleAbility->state = BattleAbility::STATUS_SHOULD_BE_USED;
        $battleAbility->save();
        $abilityBuilder = app(AbilityBuilder::class);
        if ($battleAbility->charge_last) {
            $battleAbility->charge_last--;
        }
        $battleAbility->state = BattleAbility::STATUS_CAN_BE_USED;
        $modifiedAbilities = [
            $battleAbility->slug => $battleAbility
        ];
        $keyboard = $abilityBuilder->buildAbilityKeyboard($battlePlayer, $modifiedAbilities);

        if ($battleAbility->activation_text) {
            $text = MessageFormer::formOperationText($battleAbility->activation_text, collect([
                'name' => $battlePlayer->user_name
            ]));
            $message = $this->telegram->sendKeyboardReplyMessage(
                $battle->chat->tg_id,
                $text,
                (string)$message->messageId,
                $keyboard
            );
            $battlePlayer->tg_message_id = $message->messageId;
            $battlePlayer->save();
        }
    }
}
