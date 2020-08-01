<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Battle
 *
 * @property int $id
 * @property int $state
 * @property int $chat_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Chat $chat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Battle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Battle extends Model
{
    public const BATTLE_STATE_NEW = 0;
    public const BATTLE_STATE_IN_PROCESS = 1;
    public const BATTLE_STATE_FINISHED = 2;

    protected $fillable = [
        'state',
        'chat_id',
    ];

    /**
     * @return BelongsTo|Chat
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
