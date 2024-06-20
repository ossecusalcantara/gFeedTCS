<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OfficeRepository;
use App\Entities\Office;
use App\Validators\OfficeValidator;

/**
 * Class OfficeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OfficeRepositoryEloquent extends BaseRepository implements OfficeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Office::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OfficeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function selectBoxList(string $descricao = 'name', string $chave = 'id')
    {
        return $this->model->orderBy($descricao, 'asc')->pluck($descricao, $chave)->all();
    }
    
}
