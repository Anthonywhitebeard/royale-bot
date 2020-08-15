<?php


namespace App\Models;

use App\Models\BattleModels\BattleClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
 */
class Ability extends Model
{
    use Culture;

    /** @var string[] */
    protected $fillable = [
        'active',
        'name',
        'slug',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function battleClass(): BelongsTo
    {
        return $this->belongsTo(BattleClass::class);
    }
}
