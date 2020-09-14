<?php

return [
    'name' => 'Главное не бухтеть',
    'text' => 'Понижает интеллект (и урон) всему столу кроме кремлебота',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '"Есть инфа от знающего человека, что у нас в стране скоро ожидаются реальные изменения. После того, как стабилизируют ситуацию в Сирии, уничтожат ИГИЛ (запрещенная в королевской битве организация). Тогда везде и сформируют торговый альянс со средним востоком. Нефть поднимут и будут держать, Европа ничего не сможет сделать. Сейчас главное не бухтеть." (с) %turnAlivePlayers.0.name%',
        ],
        [
            'operation' => 'MODIFY_DMG_ALL',
            'target' => '0',
            'params' => '-10',
        ],
        [
            'operation' => 'MODIFY_DMG',
            'target' => '0',
            'params' => '20',
        ],
    ],
    'conditions' => [
        "kreml_class",
        "2_players"
    ],
    'traits' => [
        "heal",
    ]
];
