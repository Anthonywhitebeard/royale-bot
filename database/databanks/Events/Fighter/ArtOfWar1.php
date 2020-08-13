<?php

return [
    'name' => 'Исскуство войны 1',
    'text' => 'Пишет в чат цитату Сунь Цзы',
    'weight' => '50',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'В пылу битвы %turnAlivePlayers.0.name% вспомнил цитату из Исскуства Войны Сунь Цзы - "Одержать сто побед в ста битвах — это не вершина воинского искусства. Повергнуть врага без сражения — вот вершина.". Преисполнившись мудростью, %turnAlivePlayers.0.name% решил избегать неприятностей',
        ],
    ],
    'conditions' => [
        "fighter_class"
    ],
    'traits' => [
        "skip turn"
    ]
];
