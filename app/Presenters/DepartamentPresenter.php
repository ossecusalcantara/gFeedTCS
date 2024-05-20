<?php

namespace App\Presenters;

use App\Transformers\DepartamentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DepartamentPresenter.
 *
 * @package namespace App\Presenters;
 */
class DepartamentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DepartamentTransformer();
    }
}
