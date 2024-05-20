<?php

namespace App\Presenters;

use App\Transformers\CharacteristicsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CharacteristicsPresenter.
 *
 * @package namespace App\Presenters;
 */
class CharacteristicsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CharacteristicsTransformer();
    }
}
