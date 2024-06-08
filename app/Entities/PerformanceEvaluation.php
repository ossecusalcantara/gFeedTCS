<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PerformanceEvaluation.
 *
 * @package namespace App\Entities;
 */
class PerformanceEvaluation extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notes',
        'deadline',
        'media',
        'admin_id',
        'manager_id',
        'user_id',
        'level'
    ];

    protected $table = 'performance_evaluations';

    protected $appends = [
        'formatted_deadline',
    ];

    protected function formattedDeadline() : Attribute
    {
        return Attribute::make(
            get:fn () => formatData($this->deadline)
        );

    }

    protected function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
