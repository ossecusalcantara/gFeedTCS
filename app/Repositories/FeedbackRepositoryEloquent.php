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

        $count['countYear'] =  $this->model->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfYear, $today])
            ->count();

        $count['countMounth'] =  $this->model->where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $today])
            ->count();

        return  $count;

    }

    public function getRecentActivities($userId) {

        $startOfYear  = Carbon::now()->startOfYear();
        $today = Carbon::today();

        $received =  $this->model->where('user_id', $userId)->count();
        $register =  $this->model->where('register_id', $userId)->count();
        
        $data = [];
        array_push($data, ['value' => $received , 'name' => 'Feedbacks Recebidos']);
        array_push($data, ['value' => $register , 'name' => 'Feedbacks Registrados']);

        return $data;
    }

}
