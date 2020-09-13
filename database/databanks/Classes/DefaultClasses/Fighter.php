<?php

use App\Services\BattleProcess\PlayerState;

return
    [
        'name' => 'Воин',
        'flag' => 'fighter',
        'deviance' => '0',
        'hp' => '150',
        'dmg' => '30',
        'msg' => '%turnAlivePlayers.0.name% найдя кем-то брошенную мотыгу и кусок доски, решает стать Воином',
        'conditions' => ['get_fighter_class'],
        'flags' => ['first_wind', PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'fighter'],
        'active' => 1
    ];
