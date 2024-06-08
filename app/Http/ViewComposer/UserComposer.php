<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer 
{
    public function __construct() {

    }

    public function compose(View $view): void
    {
        // Obtém o usuário autenticado
        $user = Auth::user();

        // Passa o usuário para a view
        $view->with('user', $user);
    }
}