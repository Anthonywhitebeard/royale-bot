<?php

return [
    'name' => 'Неудачный бич',
    'text' => 'Наносит урон магией по самому себе',
    'slug' => 'lucky_bane',
    'weight' => '0',
    'deviance' => '0',
    'active' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;-0.6',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% жертвует здоровьем %turnAlivePlayers.1.name%, лишь бы себе было лучше',
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'self_heal'
    ]
];
