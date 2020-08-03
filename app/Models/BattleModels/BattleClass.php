<?php

namespace App\Models\BattleModels;

use App\Models\BattlesUsers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\BattleModels\BattleClass
 *
 * @property int $id
 * @property string $name
 * @property int $event_id
 * @property int $active
 * @property-read \App\Models\BattlesUsers $battleUsers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BattleModels\BattleClass whereName($value)
 * @mixin \Eloquent
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
     * @return BelongsTo|BattlesUsers
     */
    public function battleUsers(): BelongsTo
    {
        return $this->belongsTo(BattlesUsers::class);
    }
}
