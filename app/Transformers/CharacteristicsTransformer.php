<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Characteristics;

/**
 * Class CharacteristicsTransformer.
 *
 * @package namespace App\Transformers;
 */
class CharacteristicsTransformer extends TransformerAbstract
{
    /**
     * Transform the Characteristics entity.
     *
     * @param \App\Entities\Characteristics $model
     *
     * @return array
     */
    public function transform(Characteristics $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
