<?php

return [
    'name' => 'Молитва',
    'text' => 'лечит, увеличивает урон',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% просит помощи у небес. Небеса помогают здоровьем и уроном',
        ],
    ],
    'conditions' => [
        'priest_class',
    ],
    'traits' => [
        "heal", "self", "dmg_buff",
    ],
];
