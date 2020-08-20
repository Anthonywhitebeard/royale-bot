<?php

return [
    'name' => 'Раскаяние',
    'text' => 'Активное, сбрасывает класс темного клирика, добавляет класс клирика, меняет урон на низкий, меняет хп на высокий',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'priest_class',
        ],
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'mark_of_heresy',
        ],
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '75',
        ],
        [
            'operation' => 'SET_DMG',
            'target' => '0',
            'params' => '10',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'dark_priest_class' ,
        ],
        [
            'operation' => 'ACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'abdication' ,
        ],
        [
            'operation' => 'DEACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'repentance' ,
        ],
        [
            'operation' => 'ABILITIES_MESSAGE',
            'target' => '0',
            'params' => 'Осознав свою ошибку, %turnAlivePlayers.0.name% искренне раскаивается, обретает душевный покой и вновь становится клириком',
        ],
    ],
    'conditions' => [
        'priest_class',
    ],
    'traits' => [
        "heal", "self", "ability", 'hp_buff',
    ],
    'ability' => [
        'slug' => 'repentance',
        'name' => 'Раскаяние',
        'battle_class' => 'priest',
        'activation_text' => '%name% спрашивает себя: "А правильно ли я поступаю?"',
        'active' => 0,
        'round_cd' => 1,
        'charges' => 1,
    ]
];
