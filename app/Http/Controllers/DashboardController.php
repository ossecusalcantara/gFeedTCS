<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;

class DashboardController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }  

    public function index() 
    {
        return view('user.dashboard');
    }

    public function auth(Request $request) 
    {
        $data = [
            'email'    => $request->get('username'),
            'password' => $request->get('password')
        ];

        try {

            if(env('PASSWORD_HASH')) {
                Auth::attempt($data , false);
            } else {

                $user = $this->repository->findWhere(['email' => $data['email']])->first();

                if(!$user) 
                    throw new Exception("E-mail informado é invállido", 1); 
                
                if($user->password != $data['password']) 
                    throw new Exception("Senha informado é inválida", 1); 

                Auth::login($user);
            }

            return redirect()->route('user.dashboard');
        } catch (Exception $e) {
           return $e->getMessage();
        }

        // dd($request->all());
        // echo "Auth metod";
    }
}
