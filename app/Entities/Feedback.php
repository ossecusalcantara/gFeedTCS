<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Feedback.
 *
 * @package namespace App\Entities;
 */
class Feedback extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public    $timestamps   = true;

    protected $fillable = [
        'reason',
        'notes',
        'user_id'
    ];
    protected $table = 'feedbacks';

}
