<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TypeQuestionRepository;
use App\Entities\TypeQuestion;
use App\Validators\TypeQuestionValidator;

/**
 * Class TypeQuestionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TypeQuestionRepositoryEloquent extends BaseRepository implements TypeQuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TypeQuestion::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}