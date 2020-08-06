<?php

namespace App\Models;

use App\Models\BattleModels\BattleClass;
use App\Services\BattleProcess\PlayerState;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $weight
 * @property int $deviance
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeviance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereWeight($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventCondition[] $event_conditions
 * @property-read int|null $event_conditions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTrait[] $event_traits
 * @property-read int|null $event_traits_count
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventCondition[] $eventConditions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventOperation[] $eventOperations
 * @property-read int|null $event_operations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTrait[] $eventTraits
 * @property int $players_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BattleModels\BattleClass[] $battleClass
 * @property-read int|null $battle_class_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event wherePlayersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event culture(\App\Models\Chat $chat)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event rollEvent(\App\Services\BattleProcess\BattleState $battleState)
 */
class Event extends Model
{
    use Culture;

    /** @var string */
    protected $table = 'events';

    /** @var string[] */
    protected $casts = [
        'weight' => 'int',
        'deviance' => 'int',
        'active' => 'bool'
    ];

    /** @var string[] */
    protected $fillable = [
        'name',
        'text',
        'weight',
        'deviance',
        'active'
    ];

    /**
     * @return HasMany
     */
    public function eventConditions(): HasMany
    {
        return $this->hasMany(EventCondition::class);
    }

    /**
     * @return HasMany
     */
    public function eventTraits(): HasMany
    {
        return $this->hasMany(EventTrait::class);
    }

    /**
     * @return HasMany|EventOperation[]
     */
    public function eventOperations(): HasMany
    {
        return $this->hasMany(EventOperation::class);
    }

    /**
     * @return HasMany
     */
    public function battleClass(): HasMany
    {
        return $this->hasMany(BattleClass::class);
    }

    /**
     * @param Builder|self $builder
     * @param \App\Services\BattleProcess\BattleState $battleState
     * @return mixed
     */
    public function scopeRollEvent(Builder $builder, \App\Services\BattleProcess\BattleState $battleState)
    {
        $chat = $battleState->chat;
        $player = $battleState->getAlivePlayer(0);
        return $builder->culture($chat)->inRandomOrder()
            ->doesntHave('eventConditions', 'and',
                function (Builder $builder) use ($player) {
                    $builder->whereNotIn('condition', $player->getFlags());
                });
    }
}
