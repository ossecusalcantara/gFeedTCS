<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Office.
 *
 * @package namespace App\Entities;
 */
class Office extends Model implements Transformable
{
    use TransformableTrait;

    public    $timestamps   = true;
    protected $table        = 'offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

}
