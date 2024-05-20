<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SkillProfile;

/**
 * Class SkillProfileTransformer.
 *
 * @package namespace App\Transformers;
 */
class SkillProfileTransformer extends TransformerAbstract
{
    /**
     * Transform the SkillProfile entity.
     *
     * @param \App\Entities\SkillProfile $model
     *
     * @return array
     */
    public function transform(SkillProfile $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
