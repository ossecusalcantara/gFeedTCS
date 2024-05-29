<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PerformanceEvaluationCreateRequest;
use App\Http\Requests\PerformanceEvaluationUpdateRequest;
use App\Repositories\PerformanceEvaluationRepository;
use App\Validators\PerformanceEvaluationValidator;

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

    /**
     * PerformanceEvaluationsController constructor.
     *
     * @param PerformanceEvaluationRepository $repository
     * @param PerformanceEvaluationValidator $validator
     */
    public function __construct(PerformanceEvaluationRepository $repository, PerformanceEvaluationValidator $validator)
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
        $performanceEvaluations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $performanceEvaluations,
            ]);
        }

        return view('performanceEvaluations.index', compact('performanceEvaluations'));
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

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $performanceEvaluation = $this->repository->create($request->all());

            $response = [
                'message' => 'PerformanceEvaluation created.',
                'data'    => $performanceEvaluation->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $performanceEvaluation = $this->repository->find($id);

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
                'message' => 'PerformanceEvaluation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PerformanceEvaluation deleted.');
    }
}
