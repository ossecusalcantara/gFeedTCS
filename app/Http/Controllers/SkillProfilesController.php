<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SkillProfileCreateRequest;
use App\Http\Requests\SkillProfileUpdateRequest;
use App\Repositories\SkillProfileRepository;
use App\Validators\SkillProfileValidator;

/**
 * Class SkillProfilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkillProfilesController extends Controller
{
    /**
     * @var SkillProfileRepository
     */
    protected $repository;

    /**
     * @var SkillProfileValidator
     */
    protected $validator;

    /**
     * SkillProfilesController constructor.
     *
     * @param SkillProfileRepository $repository
     * @param SkillProfileValidator $validator
     */
    public function __construct(SkillProfileRepository $repository, SkillProfileValidator $validator)
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
        $skillProfiles = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skillProfiles,
            ]);
        }

        return view('skillProfiles.index', compact('skillProfiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkillProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SkillProfileCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $skillProfile = $this->repository->create($request->all());

            $response = [
                'message' => 'SkillProfile created.',
                'data'    => $skillProfile->toArray(),
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
        $skillProfile = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skillProfile,
            ]);
        }

        return view('skillProfiles.show', compact('skillProfile'));
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
        $skillProfile = $this->repository->find($id);

        return view('skillProfiles.edit', compact('skillProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkillProfileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SkillProfileUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $skillProfile = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SkillProfile updated.',
                'data'    => $skillProfile->toArray(),
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
                'message' => 'SkillProfile deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SkillProfile deleted.');
    }
}
