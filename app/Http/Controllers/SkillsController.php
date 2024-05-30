<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SkillCreateRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Repositories\SkillRepository;
use App\Validators\SkillValidator;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class SkillsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkillsController extends Controller
{
    /**
     * @var SkillRepository
     */
    protected $repository;

    /**
     * @var SkillValidator
     */
    protected $validator;

    /**
     * SkillsController constructor.
     *
     * @param SkillRepository $repository
     * @param SkillValidator $validator
     */
    public function __construct(SkillRepository $repository, SkillValidator $validator)
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
        return view('skill.index');
    }

    public function listagem() {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $skills = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skills,
            ]);
        }

        return view('skill.listagem', ['skills'=> $skills]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkillCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SkillCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $request = $this->repository->create($request->all());
            $skill = $request['success'] ? $request['data'] : null;

            session()->flash('success', [
                'success' 	=> $request['success'],
                'messages' 	=> $request['messages']
            ]);

            return redirect()->route('skill.index');

        } catch (ValidatorException $e) {
            switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessage()];
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
        
        $skill = $this->repository->find($id);

        return view('skill.show', ['skill' => $skill]);
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
        $skill = $this->repository->find($id);

        return view('skill.edit', ['skill' => $skill]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkillUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SkillUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $skill = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Skill updated.',
                'data'    => $skill->toArray(),
            ];

            //return redirect()->back()->with('message', $response['message']);
            return redirect()->route('skill.listagem');
        }  catch (ValidatorException $e) {
            switch(get_class($e))
            {
                case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
                case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessage()];
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

        try{

            $deleted = $this->repository->delete($id);

            $response = [
				'success' 	=> true,
				'messages' 	=> "Skill removida.",
				'data' 	  	=> null,
			];

            //return redirect()->back()->with('message', 'Skill deleted.');
            return redirect()->route('skill.listagem');

        } catch (ValidatorException $e) {
            switch(get_class($e))
            {
                case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
                case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessage()];
                case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
                default 						:  return ['success' => false, 'messages' => get_class($e)];
            }
        }


    }
}
