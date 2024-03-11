<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreUser;
use App\Http\Requests\Adm\UpdateUser;
use App\Http\Requests\Adm\UpdatePassword;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Role;

class UsersController extends AdmBaseController
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $users = $this->repository->paginate($request->all());

        return view('adm.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();

        return view('adm.users.create')->with(compact('roles'));
    }

    public function store(StoreUser $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $user = $this->repository->store($request->except('csrf'));

        return $this->redirectWithMessage(
            ['name' => 'adm.users.edit', 'params' => [$user->id]]
            ,['message' => 'User created with success', 'type' => 'success']
        );
    }

    public function edit($id = null)
    {
        $user = $this->repository->find($id);
        $roles = Role::get();

        return view('adm.users.edit')->with(compact('user', 'roles'));
    }

    public function update(UpdateUser $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->update($id, $request->except('email'));

        return $this->redirectWithMessage(
            ['name' => 'adm.users.edit', 'params' => [$id]]
            ,['message' => 'User edited with success', 'type' => 'success']
        );
    }

    public function password($id = null)
    {
        $user = $this->repository->find($id);

        return view('adm.users.password')->with(compact('user'));
    }

    public function updatePassword(UpdatePassword $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->updatePassword($id, $request->only('password'));

        return $this->redirectWithMessage(
            ['name' => 'adm.users.index']
            ,['message' => 'User`s password edited with success', 'type' => 'success']
        );
    }

    public function delete($id = null)
    {
        $sessionMessage = [];

        //TODO: Enable to delete many records at time.
        if ($id){
            $deleted = $this->repository->delete([$id]);

            $sessionMessage = [
                'message' => 'Register deleted with success'
                ,'type' => 'success'
            ];

            if (! $deleted){
                $sessionMessage = [
                    'message' => 'It wasn`t possible to delete the register'
                    ,'type' => 'danger'
                ];
            }
        }

        return redirect()->route('adm.users.index')->with($sessionMessage);
    }
}
