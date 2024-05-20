<?php

namespace App\Presenters;

use App\Transformers\SkillTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SkillPresenter.
 *
 * @package namespace App\Presenters;
 */
class SkillPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SkillTransformer();
    }
}
