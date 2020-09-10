<?php

return [
    'name' => 'Жертва плоти',
    'text' => 'Преобразует 20 хп в 20 урона. Без кд. Не может убить, оставляет минимум 1 хп',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-20;1',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% проводит черный ритуал, получая силу за счет своей собственной жизни',
        ],
    ],
    'conditions' => [
        'warlock_class',
    ],
    'traits' => [
        "add_damage", "self_damage", "ability"
    ],
];
