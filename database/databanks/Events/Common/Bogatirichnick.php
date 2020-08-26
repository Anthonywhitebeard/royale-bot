<?php

return [
    'name' => 'Богатырышник',
    'text' => 'Увеличивает урон',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% принимает внутрь припасенную настойку богатырышника',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "dmg_buff",
    ]
];
