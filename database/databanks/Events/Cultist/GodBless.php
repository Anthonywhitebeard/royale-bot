<?php

return [
    'name' => 'Благословление древнего',
    'text' => 'увеличивает урон 0 игроку',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'FLAG_MSG',
            'target' => '1',
            'params' => 'За верную службу культу, %turnAlivePlayers.0.name% получает благословление древних. И хотя к новому щупальцу ещё придется привыкнуть, оно точно поможет ему в бою',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
    ],
    'conditions' => [
        "cultist_class",
    ],
    'traits' => [
        'elder_cult', 'damage', 'wtf', 'elder'
    ]
];
