<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Class Skill.
 *
 * @package namespace App\Entities;
 */
class Skill extends Model implements Transformable
{
    use TransformableTrait;
    public    $timestamps   = true;
    protected $table        = 'skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'name',
        'description',
        'type'
    ];

    protected $appends = [
        'formatted_type'
    ];

    protected function formattedType() : Attribute
    {
        return Attribute::make(
            get:fn () => formatType($this->type)
        );
    }

}
