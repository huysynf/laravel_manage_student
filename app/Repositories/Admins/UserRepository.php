<?php

namespace App\Reponsitories\Admins;


use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use App\Reponsitories\BaseRepository;
use Image;

class UserRepository extends BaseRepository
{
    protected $imagePath;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->imagePath='images/users/';
    }
    public function create(array $data):User
    {
        $data['image'] = $this->model->saveImage(data['image'], $this->imagePath);
        $data['password'] = Hash::make(data['password']);
        $user=$this->model->create($data);
       return $user;
    }
    public function show($id)
    {
        return  $this->model->find($id);
    }

    public function update(array $data, $id):User
    {
        $user = $this->model->findOrFail($id);
        $current_image = $user->image;
        $data['image'] = $this->user->updateimage(data['image'], $this->imagePath, $current_image);
        $user->update($data);
        return $user;
    }

    public function destroy($id)
    {
        $user = $this->model->findOrFail($id);
        $current_image = $user->image;
        $user->delete();
        $this->user->deleteImage($current_image, $this->imagePath);
        return 'Xóa người dùng thành công';

    }

    public function setPassword($password, $id)
    {

        $password = Hash::make($password);
        $this->user->changePassword($id, $password);
        return 'Cập nhật mật khẩu thành công';

    }

}
