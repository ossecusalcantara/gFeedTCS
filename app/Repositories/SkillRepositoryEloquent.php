<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SkillRepository;
use App\Entities\Skill;
use App\Validators\SkillValidator;

/**
 * Class SkillRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkillRepositoryEloquent extends BaseRepository implements SkillRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Skill::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SkillValidator::class;
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
