<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DevelopmentPlan;

/**
 * Class DevelopmentPlanTransformer.
 *
 * @package namespace App\Transformers;
 */
class DevelopmentPlanTransformer extends TransformerAbstract
{
    /**
     * Transform the DevelopmentPlan entity.
     *
     * @param \App\Entities\DevelopmentPlan $model
     *
     * @return array
     */
    public function transform(DevelopmentPlan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
