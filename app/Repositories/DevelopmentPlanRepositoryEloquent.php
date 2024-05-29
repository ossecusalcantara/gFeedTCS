<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DevelopmentPlanRepository;
use App\Entities\DevelopmentPlan;
use App\Validators\DevelopmentPlanValidator;

/**
 * Class DevelopmentPlanRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DevelopmentPlanRepositoryEloquent extends BaseRepository implements DevelopmentPlanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DevelopmentPlan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DevelopmentPlanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
