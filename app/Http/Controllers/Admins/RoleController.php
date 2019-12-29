<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRoleRequest;
use App\Http\Requests\Users\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Repositories\Admins\RoleRepository;

class RoleController extends Controller
{
    protected $roleRepository;
    public function  __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository=$roleRepository;
    }

    public function index(Request $request)
    {
        $data=$request->only('name','permission');
        return  view('backends.roles.index')->with(['roles'=>$this->roleRepository->search($data),'permissions'=>Permission::all()]);
    }

    public function store(CreateRoleRequest $request)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Thêm mới nhóm quyền thành công',
            'data'=>$this->roleRepository->create($request->only(['name','slug']),$request->input('permissions')),
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'status'=>200,
            'message'=>'Lấy thông tin nhóm quyền thành công',
            'data'=>$this->roleRepository->show($id),
        ]);
    }

    public function edit($id)
    {
        $data=$this->roleRepository->edit($id);
        return view('backends.roles.edit')->with(['role'=>$data['role'],'permissions'=>$data['permissions'],'listPermission'=>$data['listPermission']]);
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        $this->roleRepository->update($request->all(),$id);
        return redirect()->route('roles.index')->with('message','cập nhật quyền thành công');
    }

    public function destroy($id)
    {
        return response()->json([
            'status'=>200,
            'message'=>$this->roleRepository->destroy($id),
        ]);
    }
}
