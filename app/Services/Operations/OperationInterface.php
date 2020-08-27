<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

interface OperationInterface
{
    public const OPERATIONS = [
        'MODIFY_HP' => ModifyHPOperation::class,
        'RAND_MODIFY_HP' => RandomModifyHPOperation::class,
        'SET_HP' => SetHPOperation::class,
        'MODIFY_DMG' => ModifyDMGOperation::class,
        'SET_DMG' => SetDMGOperation::class,
        'ADD_FLAG' => AddFlagOperation::class,
        'REMOVE_FLAG' => RemoveFlagOperation::class,
        'SEND_MSG' => SendMessageOperation::class,
        'UPDATE_STATE' => UpdateStateInChatOperation::class,
        'DEATH_MESSAGE' => DeathMessageOperation::class,
        'ALIVE_MESSAGE' => AliveMessageOperation::class,
        'HIT' => HitOperation::class,
        'ALIVE_ATTACK' => AliveAttackOperation::class,
        'ACTIVATE_ABILITY' => ActivateAbility::class,
        'DEACTIVATE_ABILITY' => DeactivateAbility::class,
        'USE_ABILITY' => UseAbility::class,
        'ABILITIES_MESSAGE' => SendAbilitiesMessageOperation::class,
        'ADD_FLAG_ALL' => AddFlagToAll::class,
        'REMOVE_FLAG_ALL' => RemoveFlagToAll::class,
        'MODIFY_HP_ALL' => ModifyHPToAll::class,
        'MODIFY_DMG_ALL' => ModifyDMGToAll::class,
        'REMOVE_CLASS' => RemoveClass::class,
        'SLEEP' => SleepOperation::class,
    ];

    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState;
}
