<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\BattleModels\BattleClass;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Reliese\Coders\Model\Relations\HasMany;

/**
 * App\Models\BattlePlayer
 *
 * @property int $id
 * @property int $battle_id
 * @property int $player_id
 * @property string $user_name
 * @property int $start_mmr
 * @property int $start_rp
 * @property int $start_skill
 * @property int|null $end_mmr
 * @property int|null $end_rp
 * @property int|null $end_skill
 * @property int|null $place
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Battle $battle
 * @property Player $user
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereBattleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereEndMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereEndRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereEndSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereStartMmr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereStartRp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereStartSkill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereUserName($value)
 * @mixin \Eloquent
 * @property int $class_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereClassId($value)
 * @property-read \App\Models\BattleModels\BattleClass|null $battleClass
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer wherePlayerId($value)
 * @property-read \App\Models\Player $player
 * @property string|null $tg_message_id
 * @property int $ability_status
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereAbilityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer whereTgMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer battlePlayer(\App\Models\Chat $chat, \App\Models\Player $player)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattlePlayer byChatAndPlayer(\App\Models\Chat $chat, \App\Models\Player $player)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattleAbility[] $battleAbilities
 * @property-read int|null $battle_abilities_count
 */
class BattlePlayer extends Model
{
    public const ABILITY_STATUS_CAN_USE = 0;
    public const ABILITY_STATUS_REQUESTED = 0;
    public const ABILITY_STATUS_USED = 0;

    protected $table = 'battles_players';

    protected $casts = [
        'battle_id' => 'int',
        'player_id' => 'int',
        'class_id' => 'int',
        'start_mmr' => 'int',
        'start_rp' => 'int',
        'start_skill' => 'int',
        'end_mmr' => 'int',
        'end_rp' => 'int',
        'end_skill' => 'int',
        'place' => 'int'
    ];

    protected $fillable = [
        'battle_id',
        'player_id',
        'tg_message_id',
        'class_id',
        'user_name',
        'ability_status',
        'start_mmr',
        'start_rp',
        'start_skill',
        'end_mmr',
        'end_rp',
        'end_skill',
        'place'
    ];

    /**
     * @return BelongsTo|Player
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    /**
     * @return BelongsTo|Battle
     */
    public function battle(): BelongsTo
    {
        return $this->belongsTo(Battle::class);
    }

    /**
     * @return BelongsTo
     */
    public function battleClass(): BelongsTo
    {
        return $this->belongsTo(BattleClass::class, 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function battleAbilities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BattleAbility::class);
    }

    public function scopeByChatAndPlayer(Builder $builder, Chat $chat, Player $player)
    {
        return $builder->where('player_id', $player->id)
            ->whereHas('battle', function (Builder $builder) use ($chat) {
                $builder->where('chat_id', $chat->id)
                    ->where('state', Battle::BATTLE_STATE_CLASS_SELECT);
            });
    }
}
