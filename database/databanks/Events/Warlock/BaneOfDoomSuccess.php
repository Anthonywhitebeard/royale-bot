<?php

return [
    'name' => 'Неудачный бич',
    'text' => 'Наносит урон магией по самому себе',
    'slug' => 'lucky_bane',
    'weight' => '0',
    'deviance' => '0',
    'active' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;-0.6',
        ],
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% использовал мощное проклятие на %turnAlivePlayers.1.name%. Сама судьба противника чернокнижника была проклята и уничтожена этим проклятием. Смотря на рассыпавшегося в прах соперника, %turnAlivePlayers.0.name% почувствовал приток жизненной энергии',
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        'warlock', 'self_heal'
    ]
];
