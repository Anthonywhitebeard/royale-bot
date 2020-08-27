<?php

return [
    'name' => 'Съесть несколько арбузов',
    'text' => '0-й игрок съедает несколько арбузов',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '50',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% открывает инвентарь и быстро съедает десять арбузов',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "heal", "self",
    ]
];
