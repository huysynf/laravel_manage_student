<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
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
    private $imageName;

    public function __construct()
    {
        $this->user = new User();
        $this->imagePath = 'images/users/';
    }


    public function saveimage($image)
    {

        $name = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save($this->imagePath . $name);
        return $name;
    }

    public function deleteimage($name)
    {
        if (file_exists($this->imagePath . $name) && $name != 'default.jpg') {
            unlink($this->imagePath . $name);
        }
    }

    public function updateimage($request, $currentName)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->deleteimage($currentName);
            $name = $this->saveimage($image);
            return $name;
        } else {
            return $currentName;
        }
    }

    public function index()
    {
        $users = $this->user->getPaginate(10);
        return view('backends.users.index', compact('users'));
    }

    public function store(CreateUserRequest $request)
    {

        $data = $request->except('password_confirm');
        $image = $request->file('image');
        $name = $this->saveimage($image);
        try {
            DB::beginTransaction();
            $password = $request->input('password');
            $data['password'] = Hash::make($password);
            $data['image'] = $name;
            $this->user->create($data);
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => 'Tạo mới nguoi dùng thành công',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
          $this->deleteimage($name);
            return response()->json([
                'status' => 401,
                'message' => 'có lỗi xảy ra! Thêm người dung thất bại',
            ]);
        }

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
        $data = $request->all();
        $current_image = $user->image;
        try {
            DB::beginTransaction();
            $name = $this->updateimage($request, $current_image);
            $data['image'] = $name;
            $user->update($data);
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật thông tin nguoi dùng thành công',

            ]);
        } catch (Exception $x) {
            DB::rollBack();
            return response()->json([
                'status' => 401,
                'message' => 'Có lỗi xảy ra!Cập nhật thông tin người dùng thất bại',
            ]);
        }
    }


    public function destroy($id)
    {
        try {
            $user = $this->user->findOrFail($id);
            DB::beginTransaction();
            $current_image = $user->image;
            $user->delete();
            $this->deleteimage($current_image);
            DB::commit();
            return response()->json([
                'status' => 204,
                'message' => 'Xóa người dùng thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Có lỗi xảy ra xóa thất bại',
            ]);
        }
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
