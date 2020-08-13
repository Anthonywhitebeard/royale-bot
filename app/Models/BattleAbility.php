<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BattleAbility
 *
 * @property int $id
 * @property int|null $ability_id
 * @property int $battle_player_id
 * @property int $state
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ability|null $ability
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereAbilityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereBattlePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BattleAbility extends Model
{
    const STATUS_CAN_BE_USED = 1;
    const STATUS_COOL_DOWN = 0;
    const STATUS_SHOULD_BE_USED = 2;
    protected $fillable = [
        'state',
    ];

    public function ability(): BelongsTo
    {
        return $this->belongsTo(Ability::class);
    }

}
