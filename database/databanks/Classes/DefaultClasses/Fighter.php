<?php

return
    [
        'name' => 'Воин',
        'flag' => 'fighter',
        'deviance' => '0',
        'hp' => '150',
        'dmg' => '50',
        'msg' => '%turnAlivePlayers.0.name% найдя кем-то брошенную мотыгу и кусок доски, решает стать Воином',
        'conditions' => ['get_fighter_class'],
        'flags' => ['first_wind'],
        'traits' => ['class', 'fighter'],
        'active' => 1
    ];
