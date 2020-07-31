<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Battle
 * @mixin Builder
 * @package App\Models
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
