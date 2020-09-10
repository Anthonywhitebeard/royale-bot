<?php

return [
    'name' => 'Сомнения',
    'text' => 'Наносит себе небольшой урон, зависящий от атаки',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;0.5',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% вспоминает когда-то услышанную проповедь и чувствует укол совести',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Уколы совести, мучающие  %turnAlivePlayers.0.name%, сводят бедолагу в могилу',
        ],
    ],
    'conditions' => [
        "doubts",
    ],
    'traits' => [
        "damage", "self",
    ]
];
