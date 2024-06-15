<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Repositories\QuestionRepository;
use App\Repositories\TypeQuestionRepository;
use App\Validators\QuestionValidator;
use Illuminate\Database\QueryException;
use Exception;

/**
 * Class QuestionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QuestionsController extends Controller
{
    /**
     * @var QuestionRepository
     */
    protected $repository;

    /**
     * @var QuestionValidator
     */
    protected $validator;

    protected $typeQuestions;

    /**
     * QuestionsController constructor.
     *
     * @param QuestionRepository $repository
     * @param QuestionValidator $validator
     */
    public function __construct(QuestionRepository $repository, QuestionValidator $validator, TypeQuestionRepository $typeQuestionRepository)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->typeQuestions = $typeQuestionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $typeQuestions_list = $this->typeQuestions->selectBoxList();

        return view('questions.index', ['typeQuestions_list' => $typeQuestions_list]);
    }

    public function listagem() {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $questions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $questions,
            ]);
        }

        return view('questions.listagem', ['questions'=> $questions]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(QuestionCreateRequest $request)
    {
        try {

            
            $request['order'] = $this->repository->findMax('order');
            dd($request);
            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $question = $this->repository->create($request->all());

            $response = [
                'message' => 'Question created.',
                'data'    => $question->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('questions.listagem');
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
        $question = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $question,
            ]);
        }

        return view('questions.show', compact('question'));
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
        $question = $this->repository->find($id);
        $typeQuestions_list = $this->typeQuestions->selectBoxList();

        return view('questions.edit', ['question' => $question, 'typeQuestions_list' => $typeQuestions_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QuestionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(QuestionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $question = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Question updated.',
                'data'    => $question->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('questions.listagem');
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
                'message' => 'Question deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Question deleted.');
    }
}
