<?php

return [
    'name' => 'Малое исцеление',
    'text' => 'Немного лечится',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '35',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Сложив руки в молитве, %turnAlivePlayers.0.name% восстанавливает себе немного здоровья',
        ],
    ],
    'conditions' => [
        "doubts",
    ],
    'traits' => [
        "damage", "self",
    ]
];
