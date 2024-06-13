<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PerformanceEvaluationCreateRequest;
use App\Http\Requests\PerformanceEvaluationUpdateRequest;
use App\Repositories\AnswersEvaluationRepository;
use App\Repositories\PerformanceEvaluationRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\UserRepository;
use App\Validators\PerformanceEvaluationValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class PerformanceEvaluationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PerformanceEvaluationsController extends Controller
{
    /**
     * @var PerformanceEvaluationRepository
     */
    protected $repository;

    /**
     * @var PerformanceEvaluationValidator
     */
    protected $validator;

    protected $userRepository;

    protected $questionsRepository;

    protected $answersEvaluationsRepository;

    /**
     * PerformanceEvaluationsController constructor.
     *
     * @param PerformanceEvaluationRepository $repository
     * @param PerformanceEvaluationValidator $validator
     */
    public function __construct(PerformanceEvaluationRepository $repository, PerformanceEvaluationValidator $validator, UserRepository $userRepository, QuestionRepository $questionsRepository, AnswersEvaluationRepository $answersEvaluationsRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepository = $userRepository;
        $this->questionsRepository = $questionsRepository;
        $this->answersEvaluationsRepository = $answersEvaluationsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios_list = $this->userRepository->selectBoxList();

        return view('performanceEvaluations.index', ['usuarios_list' => $usuarios_list ]);
    }

    public function listagem() 
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $performanceEvaluations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $performanceEvaluations,
            ]);
        }

        return view('performanceEvaluations.listagem', ['performanceEvaluations' => $performanceEvaluations]);

    }

    public function managerlist() 
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $performanceEvaluations = $this->repository->where( 'manager_id', Auth::id())->all();

        return view('performanceEvaluations.managerlist', ['performanceEvaluations' => $performanceEvaluations]);

    }

    public function accomplish($id) 
    {
        $performanceEvaluation = $this->repository->find($id);
       
        $questions_list = $this->questionsRepository->where('level', $performanceEvaluation->level)->get();

        return view('performanceEvaluations.accomplish', ['performanceEvaluation' => $performanceEvaluation,'questions_list' => $questions_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PerformanceEvaluationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PerformanceEvaluationCreateRequest $request)
    {
        try {

            $request['admin_id'] = Auth::id();

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $performanceEvaluation = $this->repository->create($request->all());

            $level = $this->userRepository->getPermissionUser($performanceEvaluation['user_id']);

            $performanceEvaluation['level'] =  $level;

            $response = [
                'message' => 'PerformanceEvaluation created.',
                'data'    => $performanceEvaluation->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('performanceEvaluations.index');
        } catch (ValidatorException $e) {

            switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $performanceEvaluation = $this->repository->find($id);
        
        $answersEvaluations_list = $this->answersEvaluationsRepository;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $performanceEvaluation,
            ]);
        }

        return view('performanceEvaluations.show', compact('performanceEvaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $performanceEvaluation = $this->repository->find($id);

        return view('performanceEvaluations.edit', compact('performanceEvaluation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PerformanceEvaluationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PerformanceEvaluationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $performanceEvaluation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PerformanceEvaluation updated.',
                'data'    => $performanceEvaluation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'PerformanceEvaluation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('performanceEvaluations.listagem');
    }
}
