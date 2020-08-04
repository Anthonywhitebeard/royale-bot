<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Battle
 *
 * @property int $id
 * @property int $state
 * @property int $chat_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattleState[] $battle_states
 * @property-read int|null $battle_states_count
 * @property-read \App\Models\Chat $chat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Player[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattleState[] $battleStates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattlePlayer[] $battlePlayers
 * @property-read int|null $battle_users_count
 * @property-read int|null $battle_players_count
 */
class Battle extends Model
{
    public const BATTLE_STATE_NEW = 0;
    public const BATTLE_STATE_IN_PROCESS = 1;
    public const BATTLE_STATE_FINISHED = 2;

	protected $fillable = [
		'state',
		'chat_id'
	];

    /**
     * @return BelongsTo|Chat
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

	public function battleStates()
	{
		return $this->hasMany(BattleState::class);
	}

    /**
     * @return HasMany|BattlePlayer[]
     */
    public function battlePlayers(): HasMany
    {
        return $this->hasMany(BattlePlayer::class);
    }
}
