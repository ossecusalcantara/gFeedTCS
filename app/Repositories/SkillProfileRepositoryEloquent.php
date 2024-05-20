<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\skillProfileRepository;
use App\Entities\SkillProfile;
use App\Validators\SkillProfileValidator;

/**
 * Class SkillProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkillProfileRepositoryEloquent extends BaseRepository implements SkillProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SkillProfile::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SkillProfileValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
