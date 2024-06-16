<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NotificationRepository;
use App\Entities\Notification;
use App\Validators\NotificationValidator;
use Carbon\Carbon;


/**
 * Class NotificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NotificationRepositoryEloquent extends BaseRepository implements NotificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NotificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function setNotification($userId, $text, $type, $route = '', $routeId = '') {

        $notification = Notification::create([
            'user_id' => $userId,
            'text' => $text,
            'type' => $type,
            'route' => $route,
            'route_id' => $routeId,
        ]);

    }

    public function getNotifications($userId) {

        return $this->model->where('user_id', $userId)
            ->where('view', 'N')
            ->orderBy('created_at', 'asc')->get();

    }

    public function getActivities($userId) {

        $startOfWeek  = Carbon::now()->startOfWeek(); 
        $endOfWeek    = Carbon::now()->endOfWeek(); 

        return $this->model->where('user_id', $userId)
            ->where(function ($query) {
                $query->where('type', 'R')->orWhere('type', 'N');
              })
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at', 'asc')->get();

    }

    public function setViewNotification($id) {

        $this->model->where('id', $id)->update(['view' => 'S']);

    }

    public function setViewAll($id) {
        $this->model->where('user_id', $id)->update(['view' => 'S']);
    }
    
}
