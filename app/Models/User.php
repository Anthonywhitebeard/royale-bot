<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $tg_id
 * @property int $mmr
 * @property int $rp
 * @property int $skill
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattlesUsers[] $battleUsers
 * @property-read int|null $battle_users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    protected $fillable = [
        'tg_id',
        'name',
        'mmr',
        'rp',
        'skill',
        'promo_lost',
    ];

    /**
     * @return HasMany|BattlesUsers[]
     */
    public function battleUsers(): HasMany
    {
        return $this->hasMany(BattlesUsers::class);
    }
}
