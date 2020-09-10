<?php

return [
    'name' => 'Страшные сомнения',
    'text' => 'Наносит себе небольшой урон, зависящий от атаки, и сбрасывает сомнения',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'HIT',
            'target' => '0',
            'params' => '0;2',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => 'В порыве раскаяния за все то зло, причиненное другим, %turnAlivePlayers.0.name%, дважды бьет себя по голове, выбивая из нее ту самую злосчастную проповедь',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => 'Пытаясь выколотить из головы проклятую проповедь,  %turnAlivePlayers.0.name% её разбивает...',
        ],
        [
            'operation' => 'REMOVE_FLAG',
            'target' => '0',
            'params' => 'doubts' ,
        ],
    ],
    'conditions' => [
        "doubts",
    ],
    'traits' => [
        "damage", "self", "remove_flag",
    ]
];
