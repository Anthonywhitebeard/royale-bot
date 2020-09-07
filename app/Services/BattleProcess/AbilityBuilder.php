<?php


namespace App\Services\BattleProcess;


use App\Models\Ability;
use App\Models\BattleAbility;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Services\Keyboard;
use App\Services\TelegramSender;
use Illuminate\Support\Arr;

class AbilityBuilder
{
    private TelegramSender $telegram;

    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param BattlePlayer $battlePlayer
     * @param BattleClass|null $battleClass
     */
    public static function fillBattleAbilities(BattlePlayer $battlePlayer, ?BattleClass $battleClass = null): void
    {
        $class = $battleClass ?? $battlePlayer->battleClass;
        /** @var Ability $ability */
        foreach ($class->abilities as $ability) {
            /** @var BattleAbility $newBattleAbility */
            $newBattleAbility = $ability->battleAbility()->make([
                'ability_name' => $ability->name,
                'slug' => $ability->slug,
                'activation_text' => $ability->activation_text,
                'state' => BattleAbility::STATUS_COOL_DOWN,
                'charge_last' => $ability->charges,
                'active' => $ability->active
            ]);
            $newBattleAbility->battlePlayer()->associate($battlePlayer);
            $newBattleAbility->battle()->associate($battlePlayer->battle);
            $newBattleAbility->save();
        }
    }

    public function buildAbilityKeyboard(BattlePlayer $player, array $modifiedAbilities = []): \Telegram\Bot\Keyboard\Keyboard
    {
        $playerAbilities = $player->battleAbilities;
        $usableAbility = [];
        /** @var BattleAbility $ability */
        foreach ($playerAbilities as $ability) {
            $ability = Arr::get($modifiedAbilities, $ability->slug) ?? $ability;
            if (self::isAbilityAvailable($ability)) {
                $usableAbility[] = $ability;
            }
        }
        return Keyboard::makeAbilityKeyboard($usableAbility);
    }

    public static function isAbilityAvailable(BattleAbility $ability): bool
    {
        if (!$ability->active) {
            return false;
        }

        if ($ability->charge_last <= 0 && $ability->charge_last !== null) {
            return false;
        }

        if ($ability->state === BattleAbility::STATUS_SHOULD_BE_USED) {
            return false;
        }

        return true;
    }
}
