<?php

return [
    'name' => 'Сломанный ноготь',
    'text' => 'Уменьшает урон и здоровье игроку 0',
    'weight' => '70',
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
            'params' => '-15',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% летально ломает ноготь',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% ломает ноготь, теряя в здоровье и уроне',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage", "damage_nerf",
    ]
];
