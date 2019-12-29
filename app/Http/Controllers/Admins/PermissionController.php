<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdatePermissionRequest;
use App\Repositories\Admins\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->search($request->input('name'));
        return view('backends.permissions.index', compact('permissions'));
    }

    public function show($id)
    {
        return response()->json([
            'status' => 200,
            'message' => 'lấy thông tin thành công',
            'data' => $this->permissionRepository->show($id),
        ]);
    }

    public  function update(UpdatePermissionRequest $request,$id){
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thành công',
            'data' => $this->permissionRepository->update($request->all(),$id),
        ]);
    }
}
