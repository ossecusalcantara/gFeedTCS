<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SkillProfile.
 *
 * @package namespace App\Entities;
 */
class SkillProfile extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pontuation' ,
        'user_id' ,
        'skill_id'
    ];

    protected $table = "skill_profiles";

}
