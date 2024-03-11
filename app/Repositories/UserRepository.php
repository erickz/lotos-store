<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User as Model;

class UserRepository implements UserRepositoryInterface
{
    private $model;
    private $rowsPerPage = 25;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(Array $filters = []): Collection
    {
        return $this->model->get();
    }

    public function paginate(Array $filters = []): LengthAwarePaginator
    {
        return $this->model->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function store($data = []): Model
    {
        $data['active'] = 1;
        $user = $this->model->create($data);

        $user->sendEmailVerificationNotification();

        $user->syncRoles($data['roles']);

        return $user;
    }

    public function update($id, $data): Bool
    {
        $user = $this->find($id);

        if (! $user){
            return false;
        }

        if (! isset($data['active'])){
            $user->active = 0;
        }

        $updated = $user->update($data);

        $user->syncRoles($data['roles']);

        return $updated;
    }

    public function updatePassword($id, $data)
    {
        $user = $this->find($id);

        if (! $user){
            return false;
        }

        $updated = $user->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }
}