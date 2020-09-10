<?php

return [
    'name' => 'Укус руки',
    'text' => 'Увеличивает урон, уменьшает здоровье',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-25',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '15',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name%  жаждет крови и кусает свою руку. И умирает, не справившись с круговоротом крови в замкнутой системе',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name%   жаждет крови и кусает свою руку. Вкус крови прибавляет сил',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage", "damage_buf",
    ]
];
