<?php

return [
    'name' => 'Испанская Инквизиция',
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
            'params' => 'Никто не ожидает испанскую инквизицию. Все игроки потеряли здоровье'
        ],
    ],
    'conditions' => [
        "sudden_death",
    ],
    'traits' => [
        'sudden_death',
    ]
];
