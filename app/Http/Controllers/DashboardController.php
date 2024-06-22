<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Illuminate\Support\Facades\Gate;
use App\Repositories\FeedbackRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\PerformanceEvaluationRepository;
use App\Repositories\SkillProfileRepository;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    protected $repository;
    protected $validator;
    protected $skillProfileRepository;
    protected $feedbackRepository;
    protected $evaluationRepository;
    protected $notificationRepository;

    public function __construct(
        UserRepository $repository,
        UserValidator $validator, 
        SkillProfileRepository $skillProfileRepository, 
        FeedbackRepository $feedbackRepository, 
        PerformanceEvaluationRepository $evaluationRepository,
        NotificationRepository $notificationRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->skillProfileRepository = $skillProfileRepository;
        $this->feedbackRepository     = $feedbackRepository;
        $this->evaluationRepository   = $evaluationRepository;
        $this->notificationRepository = $notificationRepository;
    }  

    public function index() 
    {
        $activities   = $this->notificationRepository->getActivities(Auth::id());

        return view('user.dashboard', ['activities' => $activities]);
    }

    public function getDadosDashboard(Request $request) {

        $idUser = Auth::id();
        $data = $this->skillProfileRepository->getDadosSkillMedia($idUser);
        $coutFeedBack = $this->feedbackRepository->getCountFeedback($idUser);
        $evaluationData = $this->evaluationRepository->getMediaPerformanceEvaluation($idUser);
        $dataRecenteFeedBack =  $this->feedbackRepository->getRecentActivities($idUser);
        $dataRecenteEvaluation = $this->evaluationRepository->getRecentActivities($idUser);

        $dataActivity = ['values' => [], 'labels' => []];
        foreach ($dataRecenteFeedBack as $value) {
            array_push($dataActivity['values'], $value['value']);
            array_push($dataActivity['labels'], $value['name']);
        }

        foreach ($dataRecenteEvaluation as $value) {
            array_push($dataActivity['values'], $value['value']);
            array_push($dataActivity['labels'], $value['name']);
        }

        return response()->json([
            'message' => 'Successfully calculated averages',
            'data' => $data,
            'evaluationData' => $evaluationData,
            'dataActivity'   => $dataActivity,
            'countFeedbackYear' => $coutFeedBack['countYear'],
            'countFeedbackMouth' => $coutFeedBack['countMounth']
        ]);

    }

    public function getDadosDashboardUserShow($userId) {

        $data = $this->skillProfileRepository->getDadosSkillMedia($userId);
        $evaluationData = $this->evaluationRepository->getMediaPerformanceEvaluation($userId);

        return response()->json([
            'message' => 'Successfully calculated averages',
            'data' => $data,
            'evaluationData' => $evaluationData,
        ]);

    }
}
