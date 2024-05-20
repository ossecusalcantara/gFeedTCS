<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Departament;

/**
 * Class DepartamentTransformer.
 *
 * @package namespace App\Transformers;
 */
class DepartamentTransformer extends TransformerAbstract
{
    /**
     * Transform the Departament entity.
     *
     * @param \App\Entities\Departament $model
     *
     * @return array
     */
    public function transform(Departament $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
