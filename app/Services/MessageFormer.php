<?php

namespace App\Services;

use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Chat;
use App\Services\BattleProcess\BattleState;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Telegram\Bot\Keyboard\Keyboard as TelegramKeyboard;

class MessageFormer
{
    /**
     * @param string $text
     * @param \ArrayAccess|BattleState $formerData
     * @return string|string[]
     */
    public static function formOperationText(string $text, \ArrayAccess $formerData)
    {
        preg_match_all('/\%[^\%]+\%/', $text, $matches);

        $baseGroup = Arr::get($matches, 0, []);
        foreach ($baseGroup as $item) {

            $variable = trim($item, '%');

            $value = Arr::get($formerData, $variable);
            if (!$value) {
                continue;
            }
            if (strpos($value, '@') !== 0) {
                $value = '`' . $value . '`';
            } else {
                $value = self::getName($value);
            }
            $text = str_replace($item, $value, $text);
        }
        return $text;
    }

    public static function getName($name): string
    {
        $name = str_replace('_', '\\_', $name);
        $name = str_replace('*', '\\*', $name);
        $name = str_replace('[', '\\[', $name);
        $name = str_replace('`', '\\`', $name);
        return  $name;
    }
}
