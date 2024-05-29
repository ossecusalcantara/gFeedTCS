<?php

namespace App\Presenters;

use App\Transformers\DevelopmentPlanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DevelopmentPlanPresenter.
 *
 * @package namespace App\Presenters;
 */
class DevelopmentPlanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DevelopmentPlanTransformer();
    }
}
