<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Notification.
 *
 * @package namespace App\Entities;
 */
class Notification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'type',
        'view',
        'user_id',
        'route',
        'route_id'
    ];
    protected $table = 'notifications';

}
