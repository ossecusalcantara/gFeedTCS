<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Question.
 *
 * @package namespace App\Entities;
 */
class Question extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
        'question_description',
        'type_question_id'
    ];
    protected $table = 'questions';

    public function type_question(): BelongsTo 
    {
        return $this->belongsTo(TypeQuestion::class, 'type_question_id');
    }

}
