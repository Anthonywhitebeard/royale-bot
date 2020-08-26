<?php

return [
    'name' => 'Переизбыток чувств',
    'text' => 'Уменьшает здоровье игроку 0',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-30',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% умирает от переизбытка чувств. Чувства голода, холода и страха',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% едва не гибнет от переизбытка чувств. Преобладали чувства голода, холода и страха',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "damage",
    ]
];
