<?php

return [
    'name' => 'Банан',
    'text' => 'Да, это был банан',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '50',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% запускает лечебный банан в %turnAlivePlayers.1.name%. Это помогает!',
        ],
    ],
    'conditions' => [
        "soraka_class",
        "2_players"
    ],
    'traits' => [
        "heal",
    ]
];
