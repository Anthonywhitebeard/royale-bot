<?php

return
    [
        'name' => 'Воин',
        'flag' => 'fighter',
        'deviance' => '0',
        'operations' => [
            'SET_HP' => '150',
            'SET_DMG' => '50',
            'SEND_MSG' => '%players.0.name% найдя кем-то брошенную мотыгу и кусок доски, решает стать Воином'
        ],
        'events' => [
            [
                ''
            ]
        ],
        'conditions' => [],
        'flags' => [],
        'traits' => []
    ];
