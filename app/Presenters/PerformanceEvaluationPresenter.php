<?php

namespace App\Presenters;

use App\Transformers\PerformanceEvaluationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PerformanceEvaluationPresenter.
 *
 * @package namespace App\Presenters;
 */
class PerformanceEvaluationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PerformanceEvaluationTransformer();
    }
}
