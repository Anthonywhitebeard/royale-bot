<?php

return [
    'name' => 'Слабость',
    'text' => 'Уменьшает урон двух противников',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_DMG',
            'target' => '1',
            'params' => '-20',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '2',
            'params' => '-20',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'Честным словом и добрым делом, %turnAlivePlayers.0.name%, объясняет противникам, что сила не выход и привывает от нее отказаться. Прислушиваются %turnAlivePlayers.1.name% и %turnAlivePlayers.2.name%',
        ],
    ],
    'conditions' => [
        "priest_class",
        "3_players",
    ],
    'traits' => [
        "damage_nerf",
    ]
];
