<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AnswersEvaluationCreateRequest;
use App\Http\Requests\AnswersEvaluationUpdateRequest;
use App\Repositories\AnswersEvaluationRepository;
use App\Validators\AnswersEvaluationValidator;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class AnswersEvaluationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AnswersEvaluationsController extends Controller
{
    /**
     * @var AnswersEvaluationRepository
     */
    protected $repository;

    /**
     * @var AnswersEvaluationValidator
     */
    protected $validator;

    /**
     * AnswersEvaluationsController constructor.
     *
     * @param AnswersEvaluationRepository $repository
     * @param AnswersEvaluationValidator $validator
     */
    public function __construct(AnswersEvaluationRepository $repository, AnswersEvaluationValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $answersEvaluations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $answersEvaluations,
            ]);
        }

        return view('answersEvaluations.index', compact('answersEvaluations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AnswersEvaluationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AnswersEvaluationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            

            // $input = $request->except('_token');
            // dd($input);
            // $answersEvaluation = $this->repository->create($input->all());

            $response = [
                'message' => 'AnswersEvaluation created.',
                //'data'    => $answersEvaluation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('performanceEvaluations.managerlist');
        }catch (ValidatorException $e) {

            //dd(get_class($e));
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
        $answersEvaluation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $answersEvaluation,
            ]);
        }

        return view('answersEvaluations.show', compact('answersEvaluation'));
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
        $answersEvaluation = $this->repository->find($id);

        return view('answersEvaluations.edit', compact('answersEvaluation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AnswersEvaluationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AnswersEvaluationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $answersEvaluation = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AnswersEvaluation updated.',
                'data'    => $answersEvaluation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
                'message' => 'AnswersEvaluation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AnswersEvaluation deleted.');
    }
}