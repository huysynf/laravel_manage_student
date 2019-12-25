<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\SetPasswordRequest;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;

class UserController extends Controller
{

    private $user;
    private $imagePath;

    public function __construct()
    {
        //  $this->middleware('check.employee');
        $this->user = new User();
        $this->imagePath = 'images/users/';
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $role = $request->input('role');
        $users = $this->user->search($name, $role);
        return view('backends.users.index', compact('users'));
    }

    public function store(CreateUserRequest $request)
    {

        $data = $request->except('password_confirm', 'image');
        $data['image'] = $this->user->saveImage($request, $this->imagePath);
        $password = $request->input('password');
        $data['password'] = Hash::make($password);
        $this->user->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Tạo mới nguoi dùng thành công',

        ]);
    }

    public function show($id)
    {
        $user = $this->user->find($id);
        return response()->json([
            'status' => 200,
            'message' => 'lấy thông tin người  dùng thành công',
            'data' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $data = $request->except('image');
        $current_image = $user->image;
        $data['image'] = $this->user->updateimage($request, $this->imagePath, $current_image);
        $user->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin nguoi dùng thành công',
        ]);
    }

    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);
        $current_image = $user->image;
        $user->delete();
        $this->user->deleteImage($current_image, $this->imagePath);
        return response()->json([
            'status' => 200,
            'message' => 'Xóa người dùng thành công',
        ]);
    }

    public function setPassword(SetPasswordRequest $request, $id)
    {

        $password = Hash::make($request->input('password'));
        $this->user->changePassword($id, $password);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật mật khẩu thành công',
        ]);
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $password = Hash::make($request->input('password'));
        $this->user->changePassword($id, $password);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật mật khẩu thành công',
        ]);
    }
}


