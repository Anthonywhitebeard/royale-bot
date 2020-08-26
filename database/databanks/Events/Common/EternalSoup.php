<?php

return [
    'name' => 'Вечный суп',
    'text' => 'Восстанавливает здоровье',
    'weight' => '50',
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
            'params' => '%turnAlivePlayers.0.name% осознаёт, что под дождем можно есть суп вечно. Чем немедленно пользуется для пополнения сил',
        ],
    ],
    'conditions' => [
        'default'
    ],
    'traits' => [
        "hill",
    ]
];
