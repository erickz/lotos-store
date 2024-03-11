<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\CustomerBankRepositoryInterface;
use App\Models\CustomerBank as Model;

class CustomerBankRepository implements CustomerBankRepositoryInterface
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
        return $this->model->get();
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function store($data = [], $customerId = 0): Model
    {
        $data['customer_id'] = $customerId;

        $user = $this->model->create($data);

        return $user;
    }

    public function update($id, $data, $customer = null): Bool
    {
        $data['customer_id'] = $customer->id;

        if (! $customer->bankAccounts->contains($id)){
            return 0;
        }

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