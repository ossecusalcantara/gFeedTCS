<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected $appends = [
        'formatted_created_at'
    ];

    public function formattedCreatedAt() : Attribute 
    {
        return Attribute::make(
            get:fn () => formattDateActivitie($this->created_at)
        );
    }


}
