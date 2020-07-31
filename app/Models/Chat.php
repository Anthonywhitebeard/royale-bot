<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Battle
 * @mixin Builder
 * @package App\Models
 */
class Chat extends Model
{
    protected $fillable = [
        'tg_id',
        'name',
        'deviance',
    ];

    /**
     * @return HasMany|Battle[]
     */
    public function battles(): HasMany
    {
        return $this->hasMany(Battle::class);
    }
}
