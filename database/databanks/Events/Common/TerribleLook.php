<?php

return [
    'name' => 'Грозный взгляд',
    'text' => 'Наносит урон 1 таргету от 0 игрока, наносит случайный урон игроку 1',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.5',
        ],
        [
            'operation' => 'RAND_MODIFY_HP',
            'target' => '0',
            'params' => '-5;-15',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% использует навык грозного взгляда',
        ],
        [
            'operation' => 'SLEEP',
            'target' => '0',
            'params' => '3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% не может удержать сердце в груди. И проигрывает турнир',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.1.name% нервничает и сбегает в страхе',
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
