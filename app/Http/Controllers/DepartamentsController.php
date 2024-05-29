<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DepartamentCreateRequest;
use App\Http\Requests\DepartamentUpdateRequest;
use App\Repositories\DepartamentRepository;
use App\Validators\DepartamentValidator;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class DepartamentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class DepartamentsController extends Controller
{
    /**
     * @var DepartamentRepository
     */
    protected $repository;

    /**
     * @var DepartamentValidator
     */
    protected $validator;

    /**
     * DepartamentsController constructor.
     *
     * @param DepartamentRepository $repository
     * @param DepartamentValidator $validator
     */
    public function __construct(DepartamentRepository $repository, DepartamentValidator $validator)
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
        return view('departaments.index');
    }

    public function listagem() {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $departaments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $departaments,
            ]);
        }

        return view('departaments.listagem', ['departaments'=> $departaments]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DepartamentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(DepartamentCreateRequest $request)
    {

        try {


            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $request = $this->repository->create($request->all());
            $departament = $request['success'] ? $request['data'] : null;

            session()->flash('success', [
                'success' 	=> $request['success'],
                'messages' 	=> $request['messages']
            ]);

            
            return redirect()->route('departament.index');

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
        $departament = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $departament,
            ]);
        }

        return view('departaments.show', compact('departament'));
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
        $departament = $this->repository->find($id);

        return view('departaments.edit', compact('departament'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DepartamentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(DepartamentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $departament = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Departament updated.',
                'data'    => $departament->toArray(),
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
                'message' => 'Departament deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Departament deleted.');
    }
}
