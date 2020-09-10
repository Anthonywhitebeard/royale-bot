<?php

return [
    'name' => 'Газ',
    'text' => 'Наносит урон всем игрокам',
    'active' => '0',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP_ALL',
            'target' => '0',
            'params' => '-20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '1',
            'params' => 'Смертельно опасный газ заполняет арену'
        ],
    ],
    'conditions' => [
        "sudden_death",
    ],
    'traits' => [
        'sudden_death',
    ]
];
