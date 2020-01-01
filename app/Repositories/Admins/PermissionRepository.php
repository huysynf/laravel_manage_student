<?php

namespace App\Repositories\Admins;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function search($name)
    {
        return $this->model->search($name);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $permision = $this->show($id);
        $permision->update($data);
        return $permision;
    }

}
