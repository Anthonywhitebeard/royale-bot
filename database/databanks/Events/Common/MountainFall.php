<?php

return [
    'name' => 'Падение с обрыва',
    'text' => 'Наносит урон 0-му игроку',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-25',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% разбивается, упав с обрыва',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% падает с обрыва, но выживает',
        ],
    ],
    'conditions' => [
        'default',
    ],
    'traits' => [
        "damage",
    ]
];
