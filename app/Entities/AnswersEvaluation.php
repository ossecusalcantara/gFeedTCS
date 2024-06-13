<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class AnswersEvaluation.
 *
 * @package namespace App\Entities;
 */
class AnswersEvaluation extends Model implements Transformable
{
    use TransformableTrait;

    public    $timestamps   = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id' ,
        'performance_evaluation_id' ,
        'notes'       ,
        'punctuation'
    ];

    protected $table = 'answers_evaluations';

    public function question(): BelongsTo 
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
