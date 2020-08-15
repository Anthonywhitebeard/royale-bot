<?php


namespace App\Services\BattleProcess;


use App\Models\Ability;
use App\Models\BattleAbility;
use App\Models\BattlePlayer;
use App\Services\Keyboard;
use App\Services\TelegramSender;

class AbilityBuilder
{
    private TelegramSender $telegram;

    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param BattlePlayer $battlePlayer
     */
    public static function fillBattleAbilities(BattlePlayer $battlePlayer): void
    {
        $class = $battlePlayer->battleClass;
        /** @var Ability $ability */
        foreach ($class->abilities as $ability) {
            /** @var BattleAbility $newBattleAbility */
            $newBattleAbility = $ability->battleAbility()->make([
                'ability_name' => $ability->name,
                'state' => BattleAbility::STATUS_COOL_DOWN,
                'charge_last' => $ability->charges,
            ]);
            $newBattleAbility->battlePlayer()->associate($battlePlayer);
            $newBattleAbility->save();
        }
    }

    public function buildAbilityKeyboard(BattlePlayer $player, BattleState $state): void
    {
        $playerAbilities = $player->battleAbilities;
        $usableAbility = [];
        /** @var BattleAbility $ability */
        foreach ($playerAbilities as $ability) {
            if ($this->isAbilityMustShown($ability, $state)) {
                $usableAbility[] = $ability;
            }
        }

        $keyboard = Keyboard::makeAbilityKeyboard($usableAbility);
        $this->telegram->sendKeyboardReplyMessage(
            $player->battle->chat->tg_id,
            'доступные способности',
            $player->tg_message_id,
            $keyboard
        );
    }

    private function isAbilityMustShown(BattleAbility $ability, BattleState $battleState): bool
    {
        if (!$ability->active) {
            return false;
        }

        if ($ability->charge_last === 0 && $ability->charge_last !== null) {
            return false;
        }

        if (($ability->last_use_turn + $ability->turn_cd) <= $battleState->turn && $ability->last_use_turn) {
            return false;
        }

        if (($ability->last_use_round + $ability->round_cd) <= $battleState->round && $ability->last_use_round) {
            return false;
        }

        return true;
    }
}
