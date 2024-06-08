<?php

namespace App\Presenters;

use App\Transformers\AnswersEvaluationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnswersEvaluationPresenter.
 *
 * @package namespace App\Presenters;
 */
class AnswersEvaluationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnswersEvaluationTransformer();
    }
}
