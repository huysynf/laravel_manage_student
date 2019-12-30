@extends('backends.layouts.app')

@section('title',' Quản lý nhóm quyền')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí nhóm quyền</h1>
        @can('create-role')
            <button class="ml-2 btn btn-sm btn-primary shadow-sm add-role"
                    title="thêm mới nhóm quyền"
                    data-toggle="modal"
                    data-target="#newRoleModal"
            ><i class="fas fa-plus fa-sm text-success"></i> Thêm mới nhóm Quyền
            </button>
        @endcan
        @can('view-permission')
            <a class="ml-2 btn btn-sm btn-primary shadow-sm add-role" href="{{route('permissions.index')}}"
               title="quản lí quyền"
            ><i class="fas fa-plus fa-sm text-success"></i> Quản lí Quyền
            </a>
        @endcan
    </div>
    @if(session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{session('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{--    table data--}}
    <div class="row" id="role">
        <div class="col-12 ">
            <form method="get" action="{{route('roles.index')}}" class=" p-1 d-flex"
            >
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên tìm kiếm</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm"
                           name="name" value="">
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="role">Danh sách quyền</lable>
                    <select name="permission" class="h-50 role-select-permission">
                        <option value="" {{request()->input('permission')==""?'selected':''}}>Tất cả</option>
                        @foreach($permissions as $key=>$permission)
                            <option name="permissions"
                                    {{request()->input('permission')==$permission->name?'selected':''}} value="{{$permission->name}}">{{$permission->name}}
                        @endforeach
                    </select>
                </div>
                <div class="align-self-end ml-3">
                    <button class="btn btn-primary  aqua-gradient btn-rounded btn-sm my-0" type="submit"
                            title="Tìm kiếm">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12">
            <table class="table table-bordered" id="table_data">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Quyền</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            {{$role->name}}
                        </td>
                        <td class="d-flex">

                            @can('create-role')
                                <a class="btn btn-outline-primary btn-circle" href="{{route('roles.edit',$role->id)}}">
                                    <i class="fa fa-edit text-dark"></i>
                                </a>
                            @endcan
                            @can('delete-role')
                                <button class="btn btn-outline-dark delete-role btn-circle" title="Xóa nhóm quyền"
                                        deleteId="{{$role->id}}"><i class="fas fa-trash text-danger"></i></button>
                            @endcan
                            @can('view-role')
                                <button class="btn btn-outline-success btn-circle  show-role"
                                        title="Chi tiết nhóm quyền"
                                        data-toggle="modal"
                                        showId="{{$role->id}}"
                                        data-target="#showRoleModal"><i class="fas fa-info-circle text-primary"></i>
                                </button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {{ $roles->links() }}

            </div>
        </div>
        <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog"
             aria-labelledby="newUserModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserModalTitle">Thêm mới nhóm quyền <span
                            ></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('roles.store')}}" method="post" id="new-role-form"
                          enctype="multipart/form-data">
                        <div class="modal-body text-dark ">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên hiện thị</label>
                                <input type="text" class="form-control name" name="name" value="{{old('name')}}"
                                       required>
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Tên nhóm quyền</label>
                                <input type="text" class="form-control name" name="slug" value="{{old('slug')}}"
                                       required>
                                <span class="text-danger error-slug"></span>
                            </div>
                            <div class="form-group">
                                <label for="permissions">Quyền</label>
                                <div class=" row">
                                    <div class="form-check-inline col-4 m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input   select-all" value=""> Chọn
                                            tất cả
                                        </label>
                                    </div>
                                    @foreach($permissions as $key=>$permission)
                                        <div class="form-check-inline col-4 m-0">
                                            <label class="form-check-label">
                                                @if($permission->slug=="not-permission")
                                                    <input type="checkbox" class="form-check-input  un-select-all"
                                                           checked
                                                           name="permissions[]"
                                                           value="999" {{ in_array(old('permissions'), old('permissions', [])) ? 'checked' : '' }}>
                                                    Không
                                                    có quyền
                                                @else
                                                    <input type="checkbox" class="form-check-input   select-item"
                                                           name="permissions[]"
                                                           value="{{$permission->id}}">{{$permission->name}}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <span class="text-danger error-permissions"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary new-role"><i class="fa fa-plus">
                                    Thêm mới nhóm quyền
                                </i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="showRoleModal" tabindex="-1" role="dialog"
             aria-labelledby="showRoleModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showRoleModalTitle"> Thông tin người dùng <span
                            ></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body text-dark ">
                        <div class="d-flex flex-column justify-content-between">
                            <p>Tên quyền: <span class="role-name"></span></p>
                            <p>Danh sách quyền:</p>
                            <div class="d-flex permissions-box">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
