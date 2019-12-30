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
use Illuminate\Support\Facades\Gate;
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
        $this->authorize('view-user');
        $data = $this->userRepository->search($request->only(['name', 'role']));
        return view('backends.users.index')->with([
            'users' => $data['users'],
            'roles' => $data['roles']
        ]);

    }

    public function store(CreateUserRequest $request)
    {
        $this->authorize('create-user');
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
        return response()->json([
            'status' => 200,
            'message' => 'lấy thông tin người  dùng thành công',
            'data' => $this->userRepository->show($id),
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('update-user');
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
        $this->authorize('destroy-user');
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
