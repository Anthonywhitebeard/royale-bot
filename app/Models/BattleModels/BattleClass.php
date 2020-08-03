<?php

namespace App\Models\BattleModels;

use App\Models\BattlesUser;
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
 * @property-read \App\Models\BattlesUser $battleUsers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereName($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Event|null $event
 */
class BattleClass extends Model
{
    /** @var int */
    public const CLASS_DEFAULT_HP = 100;
    /** @var int */
    public const CLASS_DEFAULT_DMG = 20;
    /** @var int */
    public const CLASS_DEFAULT_PLAYER_CONDITION = 20;

    /** @var string[] */
    protected $fillable = [
        'state',
        'chat_id',
    ];

    /**
     * @return HasMany|BattlesUser
     */
    public function battleUsers(): HasMany
    {
        return $this->hasMany(BattlesUser::class);
    }

    /**
     * @return BelongsTo|Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
