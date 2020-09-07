<?php

return [
    'name' => 'Кукловод',
    'text' => 'Заставляет обменятся ударами игрока 1 и игрока 2 ',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '2',
            'params' => '1;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '2;1',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1, 2',
            'params' => 'Словно кукловод, %turnAlivePlayers.0.name% заставляет подратся %turnAlivePlayers.1.name% и %turnAlivePlayers.2.name%',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => 'Словно кукловод, %turnAlivePlayers.0.name% заставляет в честной драке %turnAlivePlayers.1.name% убить %turnAlivePlayers.2.name%',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '2',
            'params' => 'Словно кукловод, %turnAlivePlayers.0.name% заставляет в честной драке %turnAlivePlayers.1.name% убить %turnAlivePlayers.2.name%',
        ],
    ],
    'conditions' => [
        "priest_class",
        "3_players",
    ],
    'traits' => [
        "damage", "hit",
    ]
];
