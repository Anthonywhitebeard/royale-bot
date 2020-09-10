<?php

return [
    'name' => 'Лава',
    'text' => 'Наносит урон всем игрокам',
    'active' => '0',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-50',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => 'Совершенно неожиданно для всех - пол стал лавой'
        ],
    ],
    'conditions' => [
        "sudden_death",
    ],
    'traits' => [
        'sudden_death',
    ]
];
