<?php

namespace App\Services\Operations;

use App\Services\BattleProcess\BattleState;

interface OperationInterface
{
    public const OPERATIONS = [
        'MODIFY_HP' => ModifyHPOperation::class,
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
        'ACTIVATE_ABILITY' => ActivateAbility::class,
        'DEACTIVATE_ABILITY' => DeactivateAbility::class,
        'USE_ABILITY' => UseAbility::class,
    ];

    public function operate(
        BattleState $battleState,
        string $params,
        string $target
    ): BattleState;
}
