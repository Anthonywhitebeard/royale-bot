<?php

return [
    'name' => 'Выпить зеленки',
    'text' => 'Устанавливает здоровье в 100',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '100',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% выпивает найденную зеленку и чувствует себя на все сто',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "set_hp",
    ]
];
