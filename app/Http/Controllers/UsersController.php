<?php

namespace App\Http\Controllers;

use App\Entities\Departament;
use App\Entities\Office;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\DepartamentRepository;
use App\Repositories\OfficeRepository;
use App\Repositories\UserRepository;
use App\Repositories\PermissionRepository;
use App\Validators\UserValidator;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    protected $departamentRepository;

    protected $officeRepository;

    protected $permissionRepository;



    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserValidator $validator, DepartamentRepository $departamentRepository, OfficeRepository $officeRepository, PermissionRepository $permissionRepository )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->departamentRepository = $departamentRepository;
        $this->officeRepository      = $officeRepository;
        $this->permissionRepository  = $permissionRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departament_list   = $this->departamentRepository->selectBoxList();
        $office_list        = $this->officeRepository->selectBoxList();
        $permission_list    = $this->permissionRepository->selectBoxList('description', 'name');
    
        return view('user.index', ['departament_list' => $departament_list, 'office_list' => $office_list, 'permission_list' => $permission_list]);
    }
    
    public function listagem(){
        
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $users = $this->repository->all();
    
        if (request()->wantsJson()) {
    
            return response()->json([
                'data' => $users,
            ]);
        }
    
       // return view('users.index', compact('users'));
        return view('user.listagem', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        try {

            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $usuario = $this->repository->create($request->all());

            $permission = $usuario->permission;

            $usuario = $usuario->assignPermission($permission);

            session()->flash('success', [
                'success' 	=> $request['success'],
                'messages' 	=> $request['messages']
            ]);

            return redirect()->route('user.listagem');

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
        $user = $this->repository->find($id);

        return view('user.show', ['user' => $user]);
    }

    public function userProfile($id) 
    {
        $user = $this->repository->find($id);

        return view('user.user-profile', ['user' => $user]);
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
        $user = $this->repository->find($id);

        $departament_list   = $this->departamentRepository->selectBoxList();
        $office_list        = $this->officeRepository->selectBoxList();
        $permission_list    = $this->permissionRepository->selectBoxList('description', 'name');

        return view('user.edit', ['user' => $user,'departament_list' => $departament_list, 'office_list' => $office_list, 'permission_list' => $permission_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            
            $user = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            return redirect()->route('user.listagem');
        }catch (ValidatorException $e) {

            switch(get_class($e))
			{
				case QueryException::class 		:  return ['success' => false, 'messages' => $e->getMessage()];
				case ValidatorException::class 	:  return ['success' => false, 'messages' => $e->getMessageBag()];
				case Exception::class 			:  return ['success' => false, 'messages' => $e->getMessage()];
				default 						:  return ['success' => false, 'messages' => get_class($e)];
			}
        }
    }

    public function profileUpdate(UserUpdateRequest $request, $id)
    {
        try {
            
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->file('image');
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') .  $extension);
                $request->file('image')->move(public_path('img/profile'), $imageName);
                $request['profile_picture'] = $imageName;
            }
            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $user = $this->repository->update($request->all(), $id);
            
            $response = [
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];

            return view('user.user-profile', ['user' => $user]);
            
        }catch (ValidatorException $e) {

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
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }

    public function changePassword(Request $request) {

        $data = [
            'currentPassword' =>  $request->get('currentPassword'),
            'newPassword'     =>  $request->get('newPassword'),
            'renewPassword'   =>  $request->get('renewPassword'),
        ];

        $user = Auth::user();

        if (!Hash::check($data['currentPassword'], $user->password)) {
            return redirect()->back()->with('error', 'Senha atual informada é inválida');
        }

        if ($data['newPassword'] !== $data['renewPassword']) {
            return redirect()->back()->with('error', 'A nova senha e a senha de confirmação não coincidem');
        }

        $password = bcrypt($data['newPassword']);
        $this->repository->setNewPassword($user->id, ['password' => $password]);

        return redirect()->back()->with('success', 'Senha alterada com sucesso');
    }

    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Você saiu com sucesso!');

    }
}
