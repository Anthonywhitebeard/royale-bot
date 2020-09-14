<?php

return [
    'name' => 'Удар поосхом чернокнижника',
    'text' => 'Наносит урон небольшой урон',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;0.3',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% завернув за угол, неожиданно столкнулся с %turnAlivePlayers.1.name%. Даже не попытавшись вспомнить какое-то заклинание, Чернокнижник просто ударил соперника посохом. Да так удачно, что %turnAlivePlayers.1.name% тут же испустил последнее дыхание'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% завернув за угол, неожиданно столкнулся с %turnAlivePlayers.1.name%. Даже не попытавшись вспомнить какое-то заклинание, Чернокнижник просто ударил соперника посохом, а после быстро ретировался с места нападения'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'damage'
    ]
];
