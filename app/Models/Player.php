<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Player
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player wherePromoLost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereTgId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattlePlayer[] $battlePlayers
 * @property-read int|null $battle_users_count
 * @property-read int|null $battle_players_count
 * @property int $bot
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Player whereBot($value)
 */
class Player extends Model
{
    public const DEFAULT_MMR = 1200;
    public const DEFAULT_SKILL = 1000;

	protected $table = 'players';

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
		return $this->belongsToMany(Battle::class, 'battles_players');
	}

	public function chats()
	{
		return $this->belongsToMany(Chat::class, 'chats_users');
	}

    /**
     * @return HasMany|BattlePlayer[]
     */
    public function battlePlayers(): HasMany
    {
        return $this->hasMany(BattlePlayer::class);
    }

    /**
     * @return HasOne|Bot
     */
    public function bot(): HasOne
    {
        return $this->hasOne(Bot::class);
    }
}
