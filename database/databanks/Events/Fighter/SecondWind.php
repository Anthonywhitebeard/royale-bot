<?php

return [
    'name' => 'Второе Дыхание',
    'text' => 'Восстанавливает 30 здоровья 0 цели',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '30',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% нежиданно для самого себя открыл второе дыхание и восстановил 30 здоровья',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'second_wind',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'first_wind',
        ],
    ],
    'conditions' => [
        'fighter_class',
        'first_wind'
    ],
    'traits' => [
        "heal", "self", "fighter", "event_chain_begin",
    ]
];
