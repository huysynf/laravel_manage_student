<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class UserController extends Controller
{

    private $user;
    private $imagePath;
    private $imageName;

    public function __construct()
    {
        $this->user = new User();
        $this->imagePath = 'images/users/';
    }
    public function index()
    {
        $users = $this->user->getPaginate(10);
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
            'status' => 201,
            'message' => 'Tạo mới nguoi dùng thành công',

        ]);
    }

    public function show($id)
    {
        $user = $this->user->find($id);
        return response()->json([
            'status' => 201,
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
        $this->user->deleteImage($current_image);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa người dùng thành công',
        ]);
    }

    public function search($search)
    {

        $users = $this->user->search($search);
        return response()->json([
            'satus' => 200,
            'message' => 'Có' . count($users) . ' Kết quả với từ khóa:' . $search,
            'data' => $users,
        ]);

    }

    public function setuserpassword(Request $request, $id)
    {

        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ], [
            'password.required' => 'Mật  khẩu không để trống',
            'password.min' => 'Mật khẩu lớn hơn 6 kí tụ',
            'password.confirmed' => 'Nhập lại mật khẩu phải giống mật khẩu',
        ]);
        $password = Hash::make($request->input('password'));
        $user = $this->user->changePassword($id, $password);
        return response()->json([
            'status' => 204,
            'message' => 'Cập nhật mật khẩu thành công',
        ]);
    }

    public function changepassword(Request $request, $id)
    {
        $data = $request->all();
        $this->validate($data, [
            'password' => 'required|min:6|confirmed'
        ], [
            'password.required' => 'Mật  mật khẩu',
            'password.min' => 'Mật khẩu lớn hơn 6 kí tụ',
            'password.confirmed' => 'Nhập lại mật khẩu phải giống mật khẩu',
        ]);

        $password = Hash::make($data['password']);
        $this->user->changePassword($id, $password);
        return response()->json([
            'status' => 204,
            'message' => 'Cập nhật mật khẩu thành công',
        ]);

    }
}
