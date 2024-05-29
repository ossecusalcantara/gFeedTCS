<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PerformanceEvaluation;

/**
 * Class PerformanceEvaluationTransformer.
 *
 * @package namespace App\Transformers;
 */
class PerformanceEvaluationTransformer extends TransformerAbstract
{
    /**
     * Transform the PerformanceEvaluation entity.
     *
     * @param \App\Entities\PerformanceEvaluation $model
     *
     * @return array
     */
    public function transform(PerformanceEvaluation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
