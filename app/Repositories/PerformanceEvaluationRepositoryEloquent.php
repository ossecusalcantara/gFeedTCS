<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PerformanceEvaluationRepository;
use App\Entities\PerformanceEvaluation;
use App\Validators\PerformanceEvaluationValidator;
use Illuminate\Support\Facades\Validator;


/**
 * Class PerformanceEvaluationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PerformanceEvaluationRepositoryEloquent extends BaseRepository implements PerformanceEvaluationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PerformanceEvaluation::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PerformanceEvaluationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updateEvaluationById($performanceEvaluationsId, array $data)
    {

        $validator = Validator::make($data, [
            'media' => 'required',
            'conclusion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->model->where('id', $performanceEvaluationsId)->update($data);
    }
    
}
