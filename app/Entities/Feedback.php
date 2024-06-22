<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
        'user_id',
        'register_id'
    ];
    protected $table = 'feedbacks';

    protected $appends = [
        'formatted_created_at'
    ];

    protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function formattedCreatedAt() : Attribute 
    {
        return Attribute::make(
            get:fn () => formatData($this->created_at)
        );
    }

}
