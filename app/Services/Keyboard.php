<?php


namespace App\Services;


use App\Models\BattleAbility;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Chat;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;

class Keyboard
{
    /**
     * @param Chat $chat
     * @return TelegramKeyboard
     */
    public static function battleClasses(Chat $chat): TelegramKeyboard
    {
        $keyboard = TelegramKeyboard::make()
            ->inline()
            ->setSelective(true);
        $battleClasses = BattleClass::culture($chat)->get()->toArray();
        foreach (array_chunk($battleClasses, 4) as $chunk) {
            $row = [];
            foreach ($chunk as $battleClass) {
                $row = TelegramKeyboard::inlineButton([
                    'text' => $battleClass['name'],
                    'callback_data' => 'class_' . $battleClass['flag'],
                ]);
                $keyboard->row($row);
            }
        }

        return $keyboard;
    }

    /**
     * @param Chat $chat
     * @return TelegramKeyboard
     */
    public static function useAbility(BattlePlayer $battlePlayer): ?TelegramKeyboard
    {
        if (!$battlePlayer->tg_message_id) {
            return null;
        }
        $keyboard = TelegramKeyboard::make()
            ->setSelective(true);
        $row = TelegramKeyboard::button([
            'text' => 'ability'
        ]);
        $keyboard->row($row);

        return $keyboard;
    }

    /**
     * @param BattleAbility[] $abilities
     */
    public static function makeAbilityKeyboard(array $abilities): TelegramKeyboard
    {
        $keyboard = TelegramKeyboard::make()
            ->setSelective(true);

        if (!$abilities) {
            return $keyboard->remove();
        }
        foreach ($abilities as $ability) {
            $key = TelegramKeyboard::button([
                'text' => $ability->ability_name,
                'callback_data' => $ability['id'],
            ]);
            $keyboard->row($key);
        }

        return $keyboard;
    }
}
