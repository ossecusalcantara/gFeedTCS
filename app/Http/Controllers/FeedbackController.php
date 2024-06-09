<?php

namespace App\Http\Controllers;

use App\Entities\Feedback;
use App\Entities\SkillProfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FeedbackCreateRequest;
use App\Http\Requests\FeedbackUpdateRequest;
use App\Repositories\FeedbackRepository;
use App\Repositories\SkillRepository;
use App\Repositories\UserRepository;
use App\Validators\FeedbackValidator;
use Illuminate\Support\Facades\Auth;

/**
 * Class FeedbackController.
 *
 * @package namespace App\Http\Controllers;
 */
class FeedbackController extends Controller
{
    /**
     * @var FeedbackRepository
     */
    protected $repository;

    /**
     * @var FeedbackValidator
     */
    protected $validator;

    protected $userRepository;

    protected $skillRepository;

    /**
     * FeedbackController constructor.
     *
     * @param FeedbackRepository $repository
     * @param FeedbackValidator $validator
     */
    public function __construct(FeedbackRepository $repository, FeedbackValidator $validator, UserRepository $userRepository, SkillRepository $skillRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepository = $userRepository;
        $this->skillRepository = $skillRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_list = $this->userRepository->selectBoxList();
        $skil_list = $this->skillRepository->selectBoxList();
        //dd( $user_list);
        return view('feedback.index', ['user_list' => $user_list, 'skill_list' => $skil_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FeedbackCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FeedbackCreateRequest $request)
    {
        try {

           // dd($request->all());

            $feedback = [
                'user_id' => $request->input('user_id'),
                'reason'  => $request->input('reason'),
                'notes'   => $request->input('notes'),
            ];

            
            $skills = $request->input('skill_id', []);
            $pontuations = $request->input('pontuation', []);

            $this->validator->with($feedback)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $feedback = $this->repository->create($feedback);
            
            for ($i=0; $i < count( $skills); $i++) { 
               
                $skillProfile = SkillProfile::create([
                    'user_id' => $feedback->user_id,
                    'skill_id' => $skills[$i],
                    'pontuation' => $pontuations[$i],
                ]);

            }

            $response = [
                'message' => 'Feedback created.',
                'data'    => $feedback->toArray(),
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
        $feedback = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $feedback,
            ]);
        }

        return view('feedback.show', compact('feedback'));
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
        $feedback = $this->repository->find($id);

        return view('feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FeedbackUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FeedbackUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $feedback = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Feedback updated.',
                'data'    => $feedback->toArray(),
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
                'message' => 'Feedback deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Feedback deleted.');
    }
}
