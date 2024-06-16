<?php

namespace App\Http\ViewComposer;

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
        // Obtém o usuário autenticado
        $user = Auth::user();

        $notifications = $this->notificationRepository->getNotifications($user->id);

        // Passa o usuário para a view
        $view->with('user', $user)->with('notifications', $notifications);
    }
}