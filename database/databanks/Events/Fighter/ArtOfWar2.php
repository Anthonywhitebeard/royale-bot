<?php

return [
    'name' => 'Исскуство войны 2',
    'text' => 'Сущность войны - обман',
    'weight' => '300',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '"Сущность войны — обман. Искусный должен изображать неумелость. При готовности атаковать демонстрируй подчинение. Когда ты близок — кажись далёким, но когда ты очень далеко — притворись, будто ты рядом". Именно так писал любимый писатель %turnAlivePlayers.0.name%. Просто задумавшись о мудрости древнего китайского полководца, он стал сильнее',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '10',
        ],
    ],
    'conditions' => [
        "fighter_class"
    ],
    'traits' => [
        "heal", "self",
    ]
];
