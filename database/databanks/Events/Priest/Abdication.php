<?php

return [
    'name' => 'Отречение',
    'text' => 'Активное, сбрасывает класс жреца, добавляет класс темного жреца, значительно увеличивает урон',
    'weight' => '0',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'ADD_FLAG',
            'target' => '0',
            'params' => 'dark_priest_class',
        ],
        [
            'operation' => 'SET_HP',
            'target' => '0',
            'params' => '50',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '150',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'priest_class' ,
        ],
        [
            'operation' => 'ACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'repentance' ,
        ],
        [
            'operation' => 'DEACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'abdication' ,
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Разочаровавшись во всем, %turnAlivePlayers.0.name% проклинает свою веру. А после - заключает сделку с демоном, обменяв святость и здоровье на силу',
        ],
    ],
    'conditions' => [
        'priest_class',
    ],
    'traits' => [
        "heal", "self", "ability", "dmg_buff", "set_hp", "change_ability",
    ],
    'ability' => [
        'slug' => 'abdication',
        'name' => 'Отречение',
        'battle_class' => 'priest',
        'activation_text' => '%name% закапывает странную коробку на перекрестке',
        'active' => 1,
        'round_cd' => 1,
        'charges' => 1,
    ]
];
