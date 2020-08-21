<?php

return [
    'name' => 'Вытягивание Здоровья',
    'text' => 'Наносит урон 1 цели, увеличивает урон кастеру',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-50',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '25',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% вытягивает силы из %turnAlivePlayers.0.name%, который не в силах больше этого терпеть, падает жертвой лича, который продолжает набирать силу'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% вытягивает силы из %turnAlivePlayers.0.name%, который заметив надоевшего уже лича, смог вовремя прервать его заклинание пожертвовав частью здоровья'
        ],
    ],
    'conditions' => [
        "lich_class",
        "2_players",
    ],
    'traits' => [
        'lich', 'damage'
    ]
];
