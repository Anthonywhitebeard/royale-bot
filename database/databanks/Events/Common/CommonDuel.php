<?php

return [
    'name' => 'Обмен ударами',
    'text' => 'Обмен ударами 1-го и 0-го игроков',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;1',
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;1',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'В чистом поле обменялись парой ударов %turnAlivePlayers.0.name% и %turnAlivePlayers.1.name%',
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Не выдерживая мощи противника, %turnAlivePlayers.0.name% погибает',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => 'Не выдерживая мощи противника, %turnAlivePlayers.1.name% погибает',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0;1',
            'params' => '%turnAlivePlayers.1.name% забивает противника до смерти, но все равно откидывается от полученных ран',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1;2',
            'params' => 'Герои расходятся с парой синяков',
        ],
    ],
    'conditions' => [
        '2_players',
        'default'
    ],
    'traits' => [
        "damage", "hit",
    ]
];
