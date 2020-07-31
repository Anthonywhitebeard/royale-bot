<?php
/**
 * Created by PhpStorm.
 * User: fanto
 * Date: 30.01.2020
 * Time: 2:11
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reaction
 * @mixin Builder
 * @package App\Models
 */
class Trigger extends Model
{
    protected $fillable = [
        'trigger',
        'deviance',
    ];
}
