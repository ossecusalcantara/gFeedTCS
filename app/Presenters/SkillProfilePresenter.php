<?php

namespace App\Presenters;

use App\Transformers\SkillProfileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SkillProfilePresenter.
 *
 * @package namespace App\Presenters;
 */
class SkillProfilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SkillProfileTransformer();
    }
}
