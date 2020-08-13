<?php

return [
    'name' => 'Двойной удар',
    'text' => 'Наносит двойной урон',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '1',
            'params' => '0;2',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% и %turnAlivePlayers.1.name% сошлись в битве. После первых двух пропущеных ударов, %turnAlivePlayers.1.name% решил отступить от греха подальше',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% напал на %turnAlivePlayers.1.name% и с легкостью пройдя сквозь его защиту, нанес два быстрых удара, снеся голову своему противнику',
        ],
    ],
    'conditions' => [
        "fighter_class",
        "2_players",
    ],
    'traits' => [
        "hit", "high_dmg",
    ]
];
