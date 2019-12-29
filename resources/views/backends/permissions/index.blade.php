@extends('backends.layouts.app')

@section('title',' Quản lý quyền')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí quyền</h1>
        <a class="ml-2 btn btn-sm btn-primary shadow-sm add-role" href="{{route('roles.index')}}"
           title="Quay lại trang quản lí"
        ><i class="fas fa-plus fa-undo text-success"></i> Quay lại trang quản lí
        </a>
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
    <div class="row" id="permission">
        <div class="col-12 ">
            <form method="get" action="{{route('permissions.index')}}" class=" p-1 d-flex"
            >
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên tìm kiếm</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm"
                           name="name">
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
                    <th>Slug</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            {{$permission->name}}
                        </td>
                        <td>
                            {{$permission->slug}}
                        </td>
                        <td class="d-flex">
                            <button class="btn btn-outline-primary btn-circle edit-permission"
                                    title="Cập nhật thông tin  quyền"
                                    data-toggle="modal"
                                    editId="{{$permission->id}}"
                                    data-target="#editPermissionModal">
                                <i class="fa fa-edit text-dark"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {{ $permissions->links()}}
            </div>
        </div>
        <div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog"
             aria-labelledby="newUserModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPermisionModalTitle">Thêm mới nhóm quyền <span
                            ></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('permissions.store')}}" method="post" id="update-permission-form"
                          enctype="multipart/form-data">
                        <div class="modal-body text-dark ">
                            @csrf
                            <div class="form-group">
                                <label for="">Tên hiện thị</label>
                                <input type="text" class="form-control permission-name" name="name" value="{{old('name')}}"
                                       required>
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Tên  quyền</label>
                                <input type="text" class="form-control permission-slug" name="slug" value="{{old('slug')}}" readonly
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary update-permission"><i class="fa fa-plus">
                                   Cập nhật quyền
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
