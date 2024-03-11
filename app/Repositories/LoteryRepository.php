<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\LoteryRepositoryInterface;
use App\Models\Lotery as Model;

class LoteryRepository implements LoteryRepositoryInterface
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

    public function findByInitials($initials = ''): Model
    {
        return $this->model->byInitials($initials)->first();
    }

    public function store($data = []): Model
    {
        $user = $this->model->create($data);

        $user->sendEmailVerificationNotification();

        return $user;
    }

    public function update($id, $data): Bool
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