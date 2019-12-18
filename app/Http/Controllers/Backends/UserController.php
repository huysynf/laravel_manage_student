<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\User;
use DB;
use Illuminate\Http\Request;
use Image;

class UserController extends Controller
{
    private $user;
    private $image_path;

    public function __construct()
    {
        $this->user = new User();
        $this->image_path = 'images/users/';
    }

    public function saveimage($image)
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save(public_path($this->path_image) . $name);
        return $name;
    }


    public function index()
    {
        $users = $this->user->getpaginate(10);
        return view('backends.users.index', compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(CreateUserRequest $request)
    {
        $data = $request->except('password_confirm');
        $image = $request->file('image');
        $name = $this->savestudentprofile($image);
        try {
            DB::beginTransaction();
            $password = $request->input('password');
            $data['password'] = Hash::make($password);
            $data['image'] = $name;
           $this->user->create($data);
            DB::commit();
            return response()->json([
                'status'=>201,
                'message'=>'Tạo mới nguoif dùng thành công',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            unlink($this->path_image . $name);
            return response()->json([
                'status'=>401,
                'message'=>'có lỗi xảy ra! Thêm người dung thất bại',
            ]);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
