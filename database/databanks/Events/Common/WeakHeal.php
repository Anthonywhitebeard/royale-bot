<?php

return [
    'name' => 'Слабое восстановление',
    'text' => 'Восстанавливает 50 здоровья 0 цели',
    'weight' => '100',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '10',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% приложив подорожник, восстановил себе 10 здоровья',
        ],
    ],
    'conditions' => [],
    'traits' => [
        "heal", "self",
    ]
];
