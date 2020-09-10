<?php


namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\BattleAbility
 *
 * @property int $id
 * @property int|null $ability_id
 * @property int $battle_player_id
 * @property int $state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Ability|null $ability
 * @method static Builder|BattleAbility newModelQuery()
 * @method static Builder|BattleAbility newQuery()
 * @method static Builder|BattleAbility query()
 * @method static Builder|BattleAbility whereAbilityId($value)
 * @method static Builder|BattleAbility whereBattlePlayerId($value)
 * @method static Builder|BattleAbility whereCreatedAt($value)
 * @method static Builder|BattleAbility whereId($value)
 * @method static Builder|BattleAbility whereState($value)
 * @method static Builder|BattleAbility whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $charge_last
 * @property int|null $last_use_round
 * @property int|null $last_use_turn
 * @property-read BattlePlayer $battlePlayer
 * @method static Builder|BattleAbility whereChargeLast($value)
 * @method static Builder|BattleAbility whereLastUseRound($value)
 * @method static Builder|BattleAbility whereLastUseTurn($value)
 * @property int $turn_cd
 * @property int $round_cd
 * @method static Builder|BattleAbility whereRoundCd($value)
 * @method static Builder|BattleAbility whereTurnCd($value)
 * @property string $ability_name
 * @method static Builder|BattleAbility whereAbilityName($value)
 * @property int $active
 * @method static Builder|BattleAbility whereActive($value)
 * @property string|null $activation_text
 * @method static Builder|BattleAbility whereActivationText($value)
 */
class BattleAbility extends Model
{
    public const STATUS_CAN_BE_USED = 1;
    public const STATUS_COOL_DOWN = 0;
    public const STATUS_SHOULD_BE_USED = 2;
    protected $fillable = [
        'battle_id',
        'battle_player_id',
        'state',
        'ability_name',
        'last_use_round',
        'slug',
        'last_use_turn',
        'charge_last',
        'turn_cd',
        'round_cd',
        'active',
        'activation_text',
    ];

    public function ability(): BelongsTo
    {
        return $this->belongsTo(Ability::class);
    }

    public function battlePlayer(): BelongsTo
    {
        return $this->belongsTo(BattlePlayer::class);
    }

    public function battle(): BelongsTo
    {
        return $this->belongsTo(Battle::class);
    }
}
