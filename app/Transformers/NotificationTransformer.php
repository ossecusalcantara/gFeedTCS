<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Notification;

/**
 * Class NotificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class NotificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Notification entity.
     *
     * @param \App\Entities\Notification $model
     *
     * @return array
     */
    public function transform(Notification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
