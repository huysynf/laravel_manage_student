<?php

namespace App\Repositories\Admins;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{

    protected $permissions;
    protected $rolePermisison;

    public function __construct(Role $model)
    {
        $this->model = $model;
        $this->permissions = new Permission();
        $this->rolePermisison = new RolePermission();
    }

    public function search(array $data)
    {
        return $this->model->search($data['name'] ?? null, $data['permission'] ?? null);
    }

    public function create(array $data, array $permission): Role
    {
        $role = $this->model->create($data);
        $role->permissions()->attach($permission);
        return $role;
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function edit($id)
    {
        $data['role'] = $this->show($id);
        $data['permissions'] = $this->permissions->all(['id', 'name', 'slug']);
        $data['listPermission'] = $this->model->getPermisisonIdBy($id);
        return $data;
    }

    public function update(array $data, $id): Role
    {
        $role = $this->model->findOrFail($id);
        $role->update($data);
        $role->permissions()->sync($data['permissions']);
        return $role;
    }

    public function destroy($id)
    {
        $role = $this->model->findOrFail($id);
        $role->permissions()->detach();
        $role->delete();
        return 'Xóa người dùng thành công';
    }

}
