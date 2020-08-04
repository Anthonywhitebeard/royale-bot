<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait Culture
{
    /**
     * @param Builder $builder
     * @param Chat $chat
     * @return Builder
     */
    public function scopeCulture(Builder $builder, Chat $chat)
    {
        return $builder->where('deviance', '<=', $chat->deviance)
            ->where('active', 1);
    }

}
