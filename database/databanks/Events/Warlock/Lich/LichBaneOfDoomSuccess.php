<?php

return [
    'name' => 'Удачный бич',
    'text' => 'Наносит урон магией по самому себе',
    'slug' => 'lucky_lich_bane;',
    'weight' => '0',
    'deviance' => '0',
    'active' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '30',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% направил свою костлявую руку на %turnAlivePlayers.1.name%. Темная магия прошла сквозь всё его естество, уничтожив свою цель и передавая свое могущество Личу',
        ],
    ],
    'conditions' => [
        "lich_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'self_heal'
    ]
];
