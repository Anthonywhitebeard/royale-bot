<?php

return [
    'name' => 'Молодые и Шутливые',
    'text' => 'Понижает интеллект (и урон) всему столу кроме кремлебота',
    'weight' => '400',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'SEND_MSG',
            'target' => '0',
            'params' => '"Друзья, вам не кажется что вы заигрались, а? Ну давайте разберем по частям, вами написанное. Начнем с того, что не стоит вскрывать эту тему. Складывается впечатление, что вы молодые, шутливые, контуженные и обиженные жизнью имбицилы, которым все легко. Вот сто раз наверное это уже говорили, но не раскачивайте лодку. Потому что если раскачаете, то будет плохо, и плохо будет всем. Могу вам и в глаза это сказать, готовы приехать послушать? Вы уже совершенно ничего не замечаете в своем кровавом угаре. Остановитесь и будьте людьми. Сюда лучше не лезть. Это не то. Это не Чикатило и даже не архивы спецслужб. Вся та хуйня вами написанная - это простое пиздабольство, рембо вы комнатные. От того, что вы много написали, жизнь ваша лучше не станет. Есть система, которая реально работает, не нужно ломать эту систему. Потому что последствия будут самыми печальными. Пиздеть - не мешки ворочать. Много вас таких по весне оттаяло. Про таких как вы говорят: Мама не хотела, папа не старался." (с) %turnAlivePlayers.0.name%',
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
