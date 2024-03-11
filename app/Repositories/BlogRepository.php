<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Models\Blog as Model;

class BlogRepository implements BlogRepositoryInterface
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
        $blog= $this->model->create($data);

        return $blog;
    }

    public function update($id, $data): Bool
    {
        $blog= $this->find($id);

        if (! $blog){
            return false;
        }

        $updated = $blog->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }
}