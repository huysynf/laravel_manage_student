<?php

namespace App\Repositories\Admins;


use App\Repositories\BaseRepository;
use App\User;
use DB;
use Hash;
use Image;

class UserRepository extends BaseRepository
{
    protected $imagePath;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->imagePath = 'images/users/';
    }

    public function search(array $data)
    {
        return $this->model->search($data['name'], $data['role']);
    }

    public function create(array $data): User
    {
        $image = $data['image'];
        $password = $data['password'];
        $data['image'] = $this->model->saveImage($image, $this->imagePath);
        $data['password'] = Hash::make($password);
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update(array $data, $id): User
    {
        $user = $this->model->findOrFail($id);
        if (isset($data['image'])) {
            $current_image = $user->image;
            $image = $data['image'];
            $data['image'] = $this->user->updateimage($image, $this->imagePath, $current_image);
        }
        $user->update($data);
        return $user;
    }

    public function destroy($id)
    {
        $user = $this->model->findOrFail($id);
        $current_image = $user->image;
        $user->delete();
        $this->model->deleteImage($current_image, $this->imagePath);
        return 'Xóa người dùng thành công';
    }

    public function changePassword($password, $id)
    {
        $this->model->changePassword($id,  Hash::make($password));
        return 'Cập nhật mật khẩu thành công';

    }

}
