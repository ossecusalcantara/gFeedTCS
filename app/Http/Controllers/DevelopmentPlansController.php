<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DevelopmentPlanCreateRequest;
use App\Http\Requests\DevelopmentPlanUpdateRequest;
use App\Repositories\DevelopmentPlanRepository;
use App\Validators\DevelopmentPlanValidator;

/**
 * Class DevelopmentPlansController.
 *
 * @package namespace App\Http\Controllers;
 */
class DevelopmentPlansController extends Controller
{
    /**
     * @var DevelopmentPlanRepository
     */
    protected $repository;

    /**
     * @var DevelopmentPlanValidator
     */
    protected $validator;

    /**
     * DevelopmentPlansController constructor.
     *
     * @param DevelopmentPlanRepository $repository
     * @param DevelopmentPlanValidator $validator
     */
    public function __construct(DevelopmentPlanRepository $repository, DevelopmentPlanValidator $validator)
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
        $developmentPlans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $developmentPlans,
            ]);
        }

        return view('developmentPlans.index', compact('developmentPlans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DevelopmentPlanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DevelopmentPlanCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $developmentPlan = $this->repository->create($request->all());

            $response = [
                'message' => 'DevelopmentPlan created.',
                'data'    => $developmentPlan->toArray(),
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
        $developmentPlan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $developmentPlan,
            ]);
        }

        return view('developmentPlans.show', compact('developmentPlan'));
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
        $developmentPlan = $this->repository->find($id);

        return view('developmentPlans.edit', compact('developmentPlan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DevelopmentPlanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DevelopmentPlanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $developmentPlan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DevelopmentPlan updated.',
                'data'    => $developmentPlan->toArray(),
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
                'message' => 'DevelopmentPlan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'DevelopmentPlan deleted.');
    }
}
