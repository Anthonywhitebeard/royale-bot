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
 * @property int|null $charge_last
 * @property int|null $last_use_round
 * @property int|null $last_use_turn
 * @property-read \App\Models\BattlePlayer $battlePlayer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereChargeLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereLastUseRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereLastUseTurn($value)
 * @property int $turn_cd
 * @property int $round_cd
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereRoundCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereTurnCd($value)
 * @property string $ability_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleAbility whereAbilityName($value)
 */
class BattleAbility extends Model
{
    const STATUS_CAN_BE_USED = 1;
    const STATUS_COOL_DOWN = 0;
    const STATUS_SHOULD_BE_USED = 2;
    protected $fillable = [
        'state',
        'ability_name',
        'last_use_round',
        'last_use_turn',
        'charge_last',
        'turn_cd',
        'round_cd',
        'active',
    ];

    public function ability(): BelongsTo
    {
        return $this->belongsTo(Ability::class);
    }

    public function battlePlayer(): BelongsTo
    {
        return $this->belongsTo(BattlePlayer::class);
    }
}
