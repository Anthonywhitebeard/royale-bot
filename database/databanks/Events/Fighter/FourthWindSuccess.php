<?php

return [
    'name' => 'Четвертое Дыхание',
    'text' => 'Очень сильно бафает игрока',
    'weight' => '150',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '150',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '80',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% пережив все испытания выпавшие на его голову, практически выбившись из сил, нашел причину продолжать сражаться и наконец-то открыл четвертое дыхание. %turnAlivePlayers.0.name% наполняется решимостью' ,
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'third_wind' ,
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'fourth_wind' ,
        ],
    ],
    'conditions' => [
        'third_wind', 'fighter_class'
    ],
    'traits' => [
        "heal", "self", "dmg_buff", "ultimate"
    ]
];
