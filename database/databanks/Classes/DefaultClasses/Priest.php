<?php

return
    [
        'name' => 'Клирик',
        'flag' => 'priest',
        'deviance' => '0',
        'hp' => '120',
        'dmg' => '5',
        'msg' => '%turnAlivePlayers.0.name% вдруг во что-то уверовал и решил посвятить этому жизнь. Отныне %turnAlivePlayers.0.name% клирик',
        'conditions' => ['get_priest_class'],
        'flags' => ['preaching'],
        'traits' => ['class', 'priest'],
        'active' => 1
    ];
