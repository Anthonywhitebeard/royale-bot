<?php

return [
    'name' => 'Легкие сомнения',
    'text' => 'Наносит себе урон, зависящий от атаки',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;1',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => 'Проповедь безумного клирика никак не оставляет в покое %turnAlivePlayers.0.name%, терзая его душу',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Проповедь безумного клирика доводит %turnAlivePlayers.0.name% до *роскомнадзор*',
        ],
    ],
    'conditions' => [
        "doubts",
    ],
    'traits' => [
        "damage", "self",
    ]
];
