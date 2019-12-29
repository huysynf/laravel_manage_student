@extends('backends.layouts.app')

@section('title',' Quản lý nhóm quyền')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí quyền</h1>
        <button class="ml-2 btn btn-sm btn-primary shadow-sm add-role"
                title="thêm mới nhóm quyền"
                data-toggle="modal"
                data-target="#newRoleModal"
        ><i class="fas fa-plus fa-sm text-success"></i> Thêm mới Quyền
        </button>
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
    <div class="row" id="permisison">
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
                            <button class="btn btn-outline-primary btn-circle edit-role"
                                    title="Cập nhật thông tin nhóm quyền"
                                    data-toggle="modal"
                                    editId="{{$role->id}}"
                                    data-target="#editRoleModal">
                                <i class="fa fa-edit text-dark"></i>
                            </button>
                            <button class="btn btn-outline-dark delete-role btn-circle" title="Xóa nhóm quyền"
                                    deleteId="{{$role->id}}"><i class="fas fa-trash text-danger"></i></button>
                            <button class="btn btn-outline-success btn-circle  show-role" title="Chi tiết nhóm quyền"
                                    data-toggle="modal"
                                    showId="{{$role->id}}"
                                    data-target="#showRoleModal"><i class="fas fa-info-circle text-primary"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {{ $permission->links()}}
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
                                                    <input type="checkbox" class="form-check-input  un-select-all" checked
                                                           name="permissions[]"
                                                           value="999" {{ in_array(old('permissions'), old('permissions', [])) ? 'checked' : '' }}>Không
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
    </div>
@endsection