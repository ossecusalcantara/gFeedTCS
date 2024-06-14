<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PerformanceEvaluationRepository;
use App\Entities\PerformanceEvaluation;
use App\Validators\PerformanceEvaluationValidator;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


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

    public function getMediaPerformanceEvaluation($userId) {

        $itens = $this->model->where('user_id', $userId)->orderBy('created_at', 'asc')->get();

        $mediaData = [];
        $mounthData = [];
        foreach ($itens as $item ) {

            $conclusionDate = Carbon::parse($item->conclusion);
            $monthYear = $conclusionDate->format('m/Y');
            
            array_push($mediaData, $item->media);
            array_push($mounthData, $monthYear);
            
        }

        return [$mediaData, $mounthData];

    }
    
}
