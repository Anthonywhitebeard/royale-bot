<?php

return
    [
        'name' => 'Темный Жрец',
        'flag' => 'dark_priest',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '5',
        'msg' => '-',
        'conditions' => ['get_dark_priest_class'],
        'flags' => [\App\Services\BattleProcess\PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'dark_priest'],
        'active' => 0
    ];
