<?php

return [
    'name' => 'Проклятый старый лич (урон)',
    'text' => 'Лич получает урон',
    'weight' => '0',
    'deviance' => '0',
    'active' => 0,
    'operations' => [
        [
            'operation' => 'MODIFY_HP',
            'target' => '0',
            'params' => '-50',
        ],
        [
            'operation' => 'ALIVE_MESSAGE',
            'target' => '0',
            'params' => 'Несовершенный ритуал превращения в лича дает о себе знать, %turnAlivePlayers.0.name% теряет часть своего здоровья',
        ],
        [
            'operation' => 'DEATH_MESSAGE',
            'target' => '0',
            'params' => '%turnAlivePlayers.0.name% пал жертвой своего собственного проклятия. Никто не будет сожалеть об этом',
        ],
        [
            'operation' => 'ACTIVATE_ABILITY',
            'target' => '0',
            'params' => 'lich_curse',
        ],
    ],
    'conditions' => [
        'lich_class',
    ],
    'traits' => [
        "self_damage", "ability"
    ],
    'ability' => [
        'slug' => 'lich_damage',
        'name' => 'Проклятый старый лич (урон_',
        'battle_class' => 'lich',
        'activation_text' => '',
        'active' => 0,
        'round_cd' => 0,
        'charges' => null,
    ]
];
