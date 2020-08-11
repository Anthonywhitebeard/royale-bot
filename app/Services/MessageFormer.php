<?php


namespace App\Services;


use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Chat;
use App\Services\BattleProcess\BattleState;
use Illuminate\Support\Arr;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;

class MessageFormer
{

    public static function formOperationText(string $text, BattleState $battleState)
    {
        preg_match_all('/\%[^\%]+\%/', $text, $matches);

        $baseGroup = Arr::get($matches, 0, []);
        foreach ($baseGroup as $item) {

            $variable = trim($item, '%');

            $value = Arr::get($battleState, $variable);
            if (!$value) {
                continue;
            }
            $text = str_replace($item, $value, $text);
        }
        return $text;
    }
}
