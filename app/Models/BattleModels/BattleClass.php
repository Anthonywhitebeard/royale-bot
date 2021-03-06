<?php

namespace App\Models\BattleModels;

use App\Models\Ability;
use App\Models\BattlePlayer;
use App\Models\Chat;
use App\Models\Culture;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\BattleModels\BattleClass
 *
 * @property int $id
 * @property string $name
 * @property int $event_id
 * @property int $active
 * @property-read \App\Models\BattlePlayer $battlePlayers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereName($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event|null $event
 * @property-read int|null $battle_users_count
 * @property-read int|null $battle_players_count
 * @property string $flag
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass culture(\App\Models\Chat $chat)
 * @property int $deviance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereDeviance($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ability[] $abilities
 * @property-read int|null $abilities_count
 */
class BattleClass extends Model
{
    use Culture;

    /** @var string  */
    public const BATTLE_CLASS_PREFIX = 'class_';

    /** @var int */
    public const DEFAULT_HP = 100;
    /** @var int */
    public const DEFAULT_DMG = 20;
    /** @var int */
    public const CLASS_DEFAULT_PLAYER_CONDITION = 20;

    /** @var string[] */
    protected $fillable = [
        'name',
        'flag',
        'state',
        'chat_id',
        'active',
    ];

    /**
     * @return HasMany|BattlePlayer
     */
    public function battlePlayers(): HasMany
    {
        return $this->hasMany(BattlePlayer::class);
    }

    /**
     * @return HasMany|Ability
     */
    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }

    /**
     * @return BelongsTo|Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
