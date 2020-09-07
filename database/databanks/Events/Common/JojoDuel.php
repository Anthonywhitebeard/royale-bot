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
            'params' => '0;1.5',
        ],
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '1;1.5',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '-%turnAlivePlayers.0.name%
            -%turnAlivePlayers.1.name%
            -Oh? You\'re approaching me? Instead of running away you\'re coming right to me?
            -Well, I can\'t beat the shit out of you without getting closer'
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% уничтожен под громкие крики "ORAORAORA"',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% уничтожен под громкие крики "MUDAMUDAMUDA"',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0,1',
            'params' => 'Перекрикивание "ORAORAORA" и "MUDAMUDAMUDA" закончились смертью обоих',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0,1',
            'params' => 'После недолгого перекрикивания "ORAORAORA" и "MUDAMUDAMUDA", оба отстали друг от друга',
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
