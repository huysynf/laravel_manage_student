
@extends('backends.layouts.app')

@section('title',' Quản người dùng')

@section('content')
    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí người dùng</h1>
        <button class="ml-2 btn btn-sm btn-primary shadow-sm add-user"
                title="thêm mới người dùng"
                data-toggle="modal"
                data-target="#newUserModal"
        ><i class="fas fa-plus fa-sm text-success"></i> Thêm mới người dùng
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
    <div class="row" id="user">
        <div class="col-12 ">
            <form method="get" action="{{route('users.index')}}" class=" p-1 d-flex"
                  id="subjectFormSearch">
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên tìm kiếm</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm"
                           name="name" value="">
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="role">Nhóm quyền</lable>
                    <select class="form-control user-select-role" name="role">
                        <option value=" " selected>Tất cả</option>
                        @foreach($roles as $role)
                            <option value="{{$role->name}}" {{request()->input('role')==$role->name?'selected':''}}>{{$role->name}}</option>
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
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            <img src="{{asset('images/users/'.$user->image)}}" alt=""
                                 style="max-width: 50px;max-height: 50px;" width="100%" height="100%"
                                 alt="{{$user->name}}">
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td class="d-flex">
                            @can('update-user')
                            <button class="btn btn-outline-primary btn-circle edit-user"
                                    title="Cập nhật thông tin người dùng"
                                    data-toggle="modal"
                                    editId="{{$user->id}}"
                                    data-target="#editUserModal">
                                <i class="fa fa-edit text-dark"></i>
                            </button>
                            @endcan
                            @can('delete-user')
                            <button class="btn btn-outline-dark delete-user btn-circle" title="Xóa người dùng"
                                    deleteId="{{$user->id}}"><i class="fas fa-trash text-danger"></i></button>
                            <button class="btn btn-outline-success btn-circle  show-user" title="Chi tiết người dùng"
                                    data-toggle="modal"
                                    showId="{{$user->id}}"
                                    data-target="#showUserModal"><i class="fas fa-info-circle text-primary"></i>
                            </button>@endcan
                            <button class="btn btn-outline-primary  btn-circle change-user-password " title="Đổi mật khẩu"
                                    data-toggle="modal"
                                    userId="{{$user->id}}"
                                    data-target="#setPasswordModal">
                                <i class="fas fa-key text-warning"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {{ $users->links() }}

            </div>
        </div>
        @include('backends.users.show')
        <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog"
             aria-labelledby="newUserModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserModalTitle">Thêm mới người dùng <span
                                class="classromm-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('users.store')}}" method="post" id="new-user-form"
                          enctype="multipart/form-data">
                        <div class="modal-body text-dark ">
                            @csrf
                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input type="text" class="form-control name" name="name" value="{{old('name')}}"
                                       required>
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="d-flex ">
                                <div class="form-group">
                                    <label for="">Email</label>

                                    <input type="text" class="form-control " name="email" value="{{old('email')}}"
                                    >
                                    <span class="text-danger error-email"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control " name="phone" value="{{old('phone')}}"
                                    >
                                    <span class="text-danger error-phone"></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Ảnh</label>
                                    <input type="file" class="form-control image-input" name="image"
                                    >
                                    <span class="text-danger error-image"></span>
                                </div>
                                <div>
                                    <img src="" alt="" width="100px" height="100px"
                                         style="max-height: 100%;max-width: 100%" class="image-show">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="">Quyền</label>
                                <select class="form-control user-select-role user-role" name="role_id">
                                    <option value=" " selected>---- Chọn quyền ----</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{old('role_id')==$role->id?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-role"></span>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Mật khẩu</label>
                                    <input type="password" class="form-control " name="password" id="password"
                                           value="{{old('password')}}"
                                    >
                                    <span class="text-danger error-password"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control " name="password_confirmation"
                                           value="{{old('password_confirmation')}}"
                                           id="password_confirmation"
                                    >
                                    <span class="text-danger error-password_confirmation"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary new-user"><i class="fa fa-plus">
                                    Thêm mới người dùng
                                </i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
             aria-labelledby="editUserModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalTitle">Cập nhật thông tin người dùng <span
                                class="classromm-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="update-user-form"
                          enctype="multipart/form-data">
                        <div class="modal-body text-dark ">
                            @csrf

                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input type="text" class="form-control user-name" name="name" value="{{old('name')}}"
                                       required>
                                <span class="text-danger error-name"></span>
                            </div>
                            <div class="d-flex ">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control user-email" name="email"
                                           value="{{old('email')}}"
                                    >
                                    <span class="text-danger error-email"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" class="form-control user-phone" name="phone"
                                           value="{{old('phone')}}"
                                    >
                                    <span class="text-danger error-phone"></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="">Ảnh</label>
                                    <input type="file" class="form-control image-input " name="image"
                                    >
                                    <span class="text-danger error-image"></span>
                                </div>
                                <div>
                                    <img src="" alt="" width="100px" height="100px"
                                         style="max-height: 100%;max-width: 100%" class="image-show user-image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Quyền</label>
                                <select class="form-control user-select-role user-role" name="role_id">
                                    <option value=" " selected>---- Chọn quyền ----</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{old('role_id')==$role->id?'selected':''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-role"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary update-user"><i
                                    class="fas fa-pencil-alt">
                                    Cập nhật thông tin
                                </i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="modal fade" id="setPasswordModal" tabindex="-1" role="dialog"
             aria-labelledby="setPasswordModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="setPasswordModalTitle">Đổi mật khẩu <span
                                class="classromm-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" id="set-password-form"
                    >
                        <div class="modal-body text-dark ">
                            @csrf
                            @include('backends.users.password_form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary set-password"><i
                                    class="fas fa-pencil-alt">
                                    Đổi mật khẩu
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
