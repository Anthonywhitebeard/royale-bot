<?php


namespace App\Models;

use App\Models\BattleModels\BattleClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * App\Models\Ability
 *
 * @property int $id
 * @property string $name
 * @property int|null $battle_class_id
 * @property int $event_id
 * @property int $active
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability culture(\App\Models\Chat $chat)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereBattleClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereName($value)
 * @mixin \Eloquent
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BattleModels\BattleClass|null $battleClass
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereUpdatedAt($value)
 * @property int|null $charges
 * @property int $turn_cd
 * @property int $round_cd
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattleAbility[] $battleAbility
 * @property-read int|null $battle_ability_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereRoundCd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereTurnCd($value)
 * @property string|null $activation_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ability whereActivationText($value)
 */
class BattleResult extends Model
{
    use Culture;

    /** @var string[] */
    protected $fillable = [
        'battle_id',
        'round_last',
        'turn_last',
    ];

    public function battle(): BelongsTo
    {
        return $this->belongsTo(Battle::class);
    }
}
