<?php

namespace App\Repositories\Contracts;

interface PermissionRepositoryInterface
{
    public function get();
    public function update($id, $data);
}