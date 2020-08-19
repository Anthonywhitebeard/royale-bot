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
            'params' => 'Проповедь безумного клирика никак не оставляет в покое %turnAlivePlayers.0.name%, терзая его душу',
        ],
    ],
    'conditions' => [
        "doubts",
    ],
    'traits' => [
        "damage", "self",
    ]
];
