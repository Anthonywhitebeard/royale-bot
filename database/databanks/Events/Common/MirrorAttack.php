<?php

return [
    'name' => 'Зеркальная атака',
    'text' => 'Обмен ударами',
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
            'params' => '%turnAlivePlayers.0.name% и %turnAlivePlayers.1.name% технику зеркального копирования и зеркально бьют друг друга лбами ',
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% разлетается на осколки',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% разлетается на осколки',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0,1',
            'params' => 'Оба разлетаются на осколки',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0,1',
            'params' => 'У обоих звенит в ушах',
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
