<?php


namespace App\Services;


use App\Models\BattleModels\BattleClass;
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
                    'callback_data' => $battleClass['flag'],
                ]);
                $keyboard->row($row);
            }

//            $keyboard->row($row);
        }

        return $keyboard;
    }
}
