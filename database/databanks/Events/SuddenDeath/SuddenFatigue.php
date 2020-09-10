<?php

return [
    'name' => 'Усталость',
    'text' => 'Наносит урон всем игрокам',
    'active' => '0',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => 'Игроки чувствуют усталость и теряют часть своего здоровья'
        ],
    ],
    'conditions' => [
        "sudden_death",
    ],
    'traits' => [
        'sudden_death',
    ]
];
