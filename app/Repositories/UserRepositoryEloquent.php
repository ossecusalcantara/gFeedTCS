<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function selectBoxList(string $descricao = 'name', string $chave = 'id')
    {
        return $this->model->whereNot('id', Auth::id())->orderBy($descricao, 'asc')->pluck($descricao, $chave)->all();
    }

    public function getPermissionUser($userId) {

        $user = $this->model->where('id', $userId)->first();

        if($user->permission == 'app.user')
            return 1;

        if($user->permission == 'app.manager')
            return 2;

    }

    public function setNewPassword($userId, array $data)
    {

        $validator = Validator::make($data, [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->model->where('id', $userId)->update($data);
    }
    
}
