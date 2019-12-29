<?php

namespace App\Repositories\Admins;

use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends  BaseRepository{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function search(array $data)
    {
        return $this->model->search($data['name']??null, $data['permission']??null);
    }

    public function create(array $data,array $permission): Role
    {
        $role=$this->model->create($data);
        $role->permissions()->attach($permission);
        return $role;
    }

    public function show($id)
    {
      return $this->model->findOrFail($id);
    }

    public function update(array $data, $id): Role
    {
//        $user = $this->model->findOrFail($id);
//        if (isset($data['image'])) {
//            $current_image = $user->image;
//            $image = $data['image'];
//            $data['image'] = $this->user->updateimage($image, $this->imagePath, $current_image);
//        }
//        $user->update($data);
//        return $user;
    }
    public function destroy($id)
    {
         $role = $this->model->findOrFail($id);
         $role->permissions()->detach();
         $role->delete();
        return 'Xóa người dùng thành công';
    }

}
