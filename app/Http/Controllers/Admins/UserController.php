<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\SetPasswordRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Repositories\Admins\UserRepository;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;


class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $data = $this->userRepository->search($request->only(['name', 'role']));
        return view('backends.users.index')->with([
            'users' => $data['users'],
            'roles' => $data['roles']
        ]);

    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->create($request->only([
            'name',
            'email',
            'password',
            'role_id',
            'image',
            'phone',
        ]));
        return response()->json([
            'status' => 200,
            'message' => 'Tạo mới nguoi dùng thành công',
            'data' => $user,
        ]);
    }


    public function show($id)
    {
        $user=$this->userRepository->show($id);
        return response()->json([
            'status' => 200,
            'message' => 'lấy thông tin người  dùng thành công',
            'data' =>$user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepository->update($request->only([
            'name',
            'email',
            'role_id',
            'image',
            'phone',
        ]), $id);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin nguoi dùng thành công',
            'data' => $user,
        ]);
    }

    public function destroy($id)
    {
        $message=$this->userRepository->destroy($id);
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }

    public function setPassword(SetPasswordRequest $request, $id)
    {
        $message=$this->userRepository->changePassword($request->input('password'), $id);
        return response()->json([
            'status' => 200,
            'message' =>$message,
        ]);
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $message=$this->userRepository->changePassword($request->input('password'), $id);
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }
}
