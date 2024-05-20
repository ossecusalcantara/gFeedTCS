<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\departamentRepository;
use App\Entities\Departament;
use App\Validators\DepartamentValidator;

/**
 * Class DepartamentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DepartamentRepositoryEloquent extends BaseRepository implements DepartamentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Departament::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DepartamentValidator::class;
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
