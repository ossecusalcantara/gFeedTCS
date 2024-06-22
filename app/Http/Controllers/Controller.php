<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $repository;
    protected $validator;
    protected $skillProfileRepository;
    protected $feedbackRepository;
    protected $evaluationRepository;
    protected $notificationRepository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;
    }  

    public function homepage() {
       return view('welcome');
    }

    public function fazerLogin() {
        return view('user.login');
    }

    public function auth(Request $request) 
    {
        $data = [
            'email'    => $request->get('username'),
            'password' => $request->get('password')
        ];

        try {
            
            if(env('PASSWORD_HASH')) {

                if(Auth::attempt($data , false)) {

                    $user = $this->repository->findWhere(['email' => $data['email']])->first();

                    if($user->status === 'inactive')
                        return redirect()->back()->with('error', 'Usuário Inativado, entre em contato com o setor de Recursos Humanos');
                   
                    if($user->hasPermission('app.admin'))
                        Gate::authorize('admin');

                    if($user->hasPermission('app.user'))
                        Gate::authorize('user');

                    if($user->hasPermission('app.manager'))
                        Gate::authorize('manager');

                    return redirect()->route('user.dashboard');
                } else {
                    return redirect()->back()->with('error', 'E-mail ou senha informado é inválido');
                }

            } else {

                $user = $this->repository->findWhere(['email' => $data['email']])->first();

                if (!$user) {
                    return redirect()->back()->with('error', 'E-mail informado é inválido');
                }

                if ($user->password != $data['password']) {
                    return redirect()->back()->with('error', 'Senha informada é inválida');
                }

                Auth::login($user);

                if($user->hasPermission('app.admin'))
                    Gate::authorize('admin');

                if($user->hasPermission('app.user'))
                    Gate::authorize('user');

                if($user->hasPermission('app.manager'))
                    Gate::authorize('manager');
                
            }

           return redirect()->route('user.dashboard');
        } catch (Exception $e) {
           return $e->getMessage();
        }
        
    }

    public function logout(Request $request) 
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Você saiu com sucesso!');

    }
}

