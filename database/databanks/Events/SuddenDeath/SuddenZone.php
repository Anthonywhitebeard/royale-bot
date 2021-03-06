<?php

return [
    'name' => 'Зона',
    'text' => 'Наносит урон всем игрокам',
    'active' => '0',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-15',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => 'Сужающаяся зона, подрезала часть здоровья всех игроков'
        ],
    ],
    'conditions' => [
        "sudden_death",
    ],
    'traits' => [
        'sudden_death',
    ]
];
