<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CharacteristicsRepository;
use App\Entities\Characteristics;
use App\Validators\CharacteristicsValidator;

/**
 * Class CharacteristicsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CharacteristicsRepositoryEloquent extends BaseRepository implements CharacteristicsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Characteristics::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CharacteristicsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
