<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FeedbackRepository;
use App\Entities\Feedback;
use App\Validators\FeedbackValidator;
use Carbon\Carbon;


/**
 * Class FeedbackRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FeedbackRepositoryEloquent extends BaseRepository implements FeedbackRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Feedback::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FeedbackValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCountFeedback($userId) {

        $startOfYear  = Carbon::now()->startOfYear();
        $startOfMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();

        $count = [];

        $coutn['countYear'] =  $this->model->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfYear, $today])
            ->count();

        $coutn['countMounth'] =  $this->model->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $today])
            ->count();

        return  $coutn;

    }
    
}
