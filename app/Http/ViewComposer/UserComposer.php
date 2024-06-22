<?php

namespace App\Http\ViewComposer;

use App\Entities\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer 
{

    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository) {

        $this->notificationRepository = $notificationRepository;

    }

    public function compose(View $view): void
    {

        $user = Auth::user();
 
        if(!is_null($user)) {

            $notifications = $this->notificationRepository->getNotifications($user->id);

            $view->with('user', $user)->with('notifications', $notifications);
        }
        
        $view->with('user', $user);
    }
}