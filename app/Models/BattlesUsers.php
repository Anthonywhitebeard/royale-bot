<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\BattlesUsers
 *
 * @property int $id
 * @property int $battle_id
 * @property int $user_id
 * @property string $user_name
 * @property int $start_mmr
 * @property int $start_rp
 * @property int $start_skill
 * @property int|null $end_mmr
 * @property int|null $end_rp
 * @property int|null $end_skill
 * @property int|null $place
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Battle $battle
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereBattleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereEndMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereEndRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereEndSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereStartMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereStartRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereStartSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlesUsers whereUserName($value)
 * @mixin \Eloquent
 */
class BattlesUsers extends Model
{
    protected $fillable = [
        'battle_id',
        'user_id',
        'start_mmr',
        'start_rp',
        'start_skill',
        'end_mmr',
        'end_rp',
        'end_skill',
        'place',
    ];

    /**
     * @return BelongsTo|User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo|Battle
     */
    public function battle(): BelongsTo
    {
        return $this->belongsTo(Battle::class);
    }
}