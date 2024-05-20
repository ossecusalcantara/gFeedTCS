<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Skill;

/**
 * Class SkillTransformer.
 *
 * @package namespace App\Transformers;
 */
class SkillTransformer extends TransformerAbstract
{
    /**
     * Transform the Skill entity.
     *
     * @param \App\Entities\Skill $model
     *
     * @return array
     */
    public function transform(Skill $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
