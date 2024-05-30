<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OfficeCreateRequest;
use App\Http\Requests\OfficeUpdateRequest;
use App\Repositories\OfficeRepository;
use App\Validators\OfficeValidator;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class OfficesController.
 *
 * @package namespace App\Http\Controllers;
 */
class OfficesController extends Controller
{
    /**
     * @var OfficeRepository
     */
    protected $repository;

    /**
     * @var OfficeValidator
     */
    protected $validator;

    /**
     * OfficesController constructor.
     *
     * @param OfficeRepository $repository
     * @param OfficeValidator $validator
     */
    public function __construct(OfficeRepository $repository, OfficeValidator $validator)
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
        return view('offices.index');
    }

    public function listagem() {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $offices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $offices,
            ]);
        }

        return view('offices.listagem', ['offices' => $offices]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OfficeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OfficeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $request = $this->repository->create($request->all());
            $office = $request['success'] ? $request['data'] : null;

            session()->flash('success', [
                'success' 	=> $request['success'],
                'messages' 	=> $request['messages']
            ]);

            
            return redirect()->route('office.index');

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

        $office = $this->repository->find($id);

        return view('offices.show', ['office' => $office]);
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
        $office = $this->repository->find($id);

        return view('offices.edit', ['office' => $office]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OfficeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OfficeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $office = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Office updated.',
                'data'    => $office->toArray(),
            ];

            return redirect()->route('office.listagem');
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
                'message' => 'Office deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Office deleted.');
    }
}
