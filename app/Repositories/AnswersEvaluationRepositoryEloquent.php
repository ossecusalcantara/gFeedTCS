<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnswersEvaluationRepository;
use App\Entities\AnswersEvaluation;
use App\Validators\AnswersEvaluationValidator;

/**
 * Class AnswersEvaluationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AnswersEvaluationRepositoryEloquent extends BaseRepository implements AnswersEvaluationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AnswersEvaluation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AnswersEvaluationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
