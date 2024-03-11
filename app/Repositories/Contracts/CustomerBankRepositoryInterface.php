<?php

namespace App\Repositories\Contracts;

interface CustomerBankRepositoryInterface
{
    public function get();
    public function paginate();
    public function find($id);
    public function store($data, $parentId);
    public function update($id, $data, $parentId);
    public function delete($ids);
}