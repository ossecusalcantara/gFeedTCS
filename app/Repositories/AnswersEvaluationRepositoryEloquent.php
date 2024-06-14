<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnswersEvaluationRepository;
use App\Entities\AnswersEvaluation;
use Illuminate\Support\Facades\Validator;
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

    public function getMediaEvaluations($userId) 
    {

        $this->model->where('user_id', $userId)->orderBy('created_at', 'asc')->get();

    }

    public function getAnswersEvaluations($evaluationId) 
    {
       
       return $this->model->where('performance_evaluation_id', $evaluationId)->orderBy('id', 'asc')->get();

    }

    public function setDataAnswersEvaluations($data) 
    {

        $validator = Validator::make($data, [
            'question_id' => 'required',
            'performance_evaluation_id' => 'required',
            'notes'       => 'required',
            'punctuation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $answersEvaluation = AnswersEvaluation::create($data);

    } 
    
    
}
