<?php

return [
    'name' => 'Безумный Смех',
    'text' => 'увеличивает урон 0 игроку, снимает здоровье',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-20',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% ни с того ни с сего разошёлся в диком хохоте и не смог сойтись обратно',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% ни с того ни с сего разошёлся в диком хохоте и несмотря на явно прогрессирующее психическое расстройство, почувствовал себя сильнее',
        ],
    ],
    'conditions' => [
        "cultist_class",
    ],
    'traits' => [
        'elder_cult', 'damage', 'wtf', 'elder'
    ]
];
