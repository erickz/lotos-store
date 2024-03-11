<?php

namespace App\Repositories;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Models\Permission as Model;

class PermissionRepository implements PermissionRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get()
    {
        return $this->model->get();
    }

    public function update($id, $data)
    {
        $permission = $this->find($id);

        if (! $permission){
            return false;
        }

        return $permission->attach($data);
    }
}