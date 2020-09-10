<?php

return
    [
        'name' => 'Кремлебот',
        'flag' => 'kreml',
        'deviance' => '0',
        'hp' => '200',
        'dmg' => '10',
        'msg' => 'Кремлебот проверяет методички',
        'conditions' => ['kremlebot'],
        'flags' => [\App\Services\BattleProcess\PlayerState::FLAG_DEFAULT_EVENTS],
        'traits' => ['class', 'kremlebot'],
        'active' => 0
    ];
