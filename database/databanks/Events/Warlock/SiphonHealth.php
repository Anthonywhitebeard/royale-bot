<?php

return [
    'name' => 'Вытягивание Здоровья',
    'text' => 'Наносит урон 1 цели, восстанавливает кастеру',
    'weight' => '200',
    'deviance' => '0',
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '1',
            'params' => '-50',
        ],
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-50',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% чувствует недомогание и кастует заклинание в %turnAlivePlayers.0.name%. Чернокнижник молодеет на глазах, а его противник с криками "Та за що?" падает высушеной мумией'
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '1',
            'params' => '%turnAlivePlayers.0.name% чувствует недомогание и кастует заклинание в %turnAlivePlayers.0.name%. Чернокнижник молодеет на глазах, а его противник постарев на пару лет, задумался об испорченности нынешней молодежи'
        ],
    ],
    'conditions' => [
        "warlock_class",
        "2_players",
    ],
    'traits' => [
        "self_heal", 'warlock', 'damage'
    ]
];
