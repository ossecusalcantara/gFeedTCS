<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AnswersEvaluation;

/**
 * Class AnswersEvaluationTransformer.
 *
 * @package namespace App\Transformers;
 */
class AnswersEvaluationTransformer extends TransformerAbstract
{
    /**
     * Transform the AnswersEvaluation entity.
     *
     * @param \App\Entities\AnswersEvaluation $model
     *
     * @return array
     */
    public function transform(AnswersEvaluation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
