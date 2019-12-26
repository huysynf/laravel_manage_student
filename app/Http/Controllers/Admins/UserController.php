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
        $this->middleware('check.employee');
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        return view('backends.users.index')->with('users',
            $this->userRepository->search($request->only(['name', 'role'])));
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->create($request->only([
            'name',
            'email',
            'password',
            'role',
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
        return response()->json([
            'status' => 200,
            'message' => 'lấy thông tin người  dùng thành công',
            'data' => $this->userRepository->show($id),
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userRepository->update($request->only([
            'name',
            'email',
            'role',
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
        return response()->json([
            'status' => 200,
            'message' => $this->userRepository->destroy($id),
        ]);
    }

    public function setPassword(SetPasswordRequest $request, $id)
    {
        return response()->json([
            'status' => 200,
            'message' => $this->userRepository->changePassword($request->input('password'), $id),
        ]);
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        return response()->json([
            'status' => 200,
            'message' => $this->userRepository->changePassword($request->input('password'), $id),
        ]);
    }
}


