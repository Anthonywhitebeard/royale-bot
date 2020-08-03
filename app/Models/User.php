<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
 * @property bool $promo_lost
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Battle[] $battles
 * @property-read int|null $battles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read int|null $chats_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePromoLost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattlesUser[] $battleUsers
 * @property-read int|null $battle_users_count
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'mmr' => 'int',
		'rp' => 'int',
		'skill' => 'int',
		'promo_lost' => 'bool'
	];

	protected $fillable = [
		'name',
		'tg_id',
		'mmr',
		'rp',
		'skill',
		'promo_lost'
	];

	public function battles()
	{
		return $this->belongsToMany(Battle::class, 'battles_users');
	}

	public function chats()
	{
		return $this->belongsToMany(Chat::class, 'chats_users');
	}

    /**
     * @return HasMany|BattlesUser[]
     */
    public function battleUsers(): HasMany
    {
        return $this->hasMany(BattlesUser::class);
    }
}
