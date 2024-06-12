<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Support\Facades\Gate;
use App\Repositories\FeedbackRepository;
use App\Repositories\PerformanceEvaluationRepository;
use App\Repositories\SkillProfileRepository;

class DashboardController extends Controller
{
    protected $repository;
    protected $validator;
    protected $skillProfileRepository;
    protected $feedbackRepository;
    protected $evaluationRepository;

    public function __construct(UserRepository $repository, UserValidator $validator, SkillProfileRepository $skillProfileRepository, FeedbackRepository $feedbackRepository, PerformanceEvaluationRepository $evaluationRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->skillProfileRepository = $skillProfileRepository;
        $this->feedbackRepository     = $feedbackRepository;
        $this->evaluationRepository   = $evaluationRepository;
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

    public function getDadosDashboard(Request $request) {

        $idUser = Auth::id();
        $data = $this->skillProfileRepository->getDadosSkillMedia(6);

        return response()->json([
            'message' => 'Successfully calculated averages',
            'data' => $data
        ]);

    }
}
