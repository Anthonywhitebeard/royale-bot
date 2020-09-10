<?php

return [
    'name' => 'Зов древнего',
    'text' => 'Массово снижает урон всех игроков',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => 'На мгновение, время будто остановилось, а перед участниками битвы возникло видение. Тварь, описать которую не представляется возможным – ибо нет языка, способного передать такую бездну вопящего и не удерживающегося в памяти безумия, такого категорического несоответствия всем законам материи, энергии и космического порядка. Оно стало протискивать Свою зеленую желеобразную безмерность сквозь... сквозь видение, пытаясь пробраться в эту реальность сквозь вас. Но мгновением спустя, видение исчезло и реальный мир вернулся. Чувствуя, что надвигается нечто ужасное, все игроки теряют уверенность в своих силах',
        ],
        [
            'operation' => 'REMOVE_FLAG_ALL',
            'target' => '0',
            'params' => 'elder_1',
        ],
        [
            'operation' => 'ADD_FLAG_ALL',
            'target' => '0',
            'params' => 'elder_2',
        ],
        [
            'operation' => 'MODIFY_DMG_ALL',
            'target' => '0',
            'params' => '-10',
        ],
    ],
    'conditions' => [
        "elder_1",
    ],
    'traits' => [
        'cultist', 'damage', 'wtf', 'elder', 'cthulhu'
    ]
];
