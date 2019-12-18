@extends('backends.layouts.app')

@section('title',' Quản lý sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí người dùng</h1>
        <a href="{{route('users.create')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="thêm mới người dùng"
           data-toggle="modal"
           data-target="#newUserModal"
        > <i class="fas fa-plus fa-sm text-success"></i> thêm mới người dùng
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
    <div class="row" id="user">
        <div class="col-12 d-flex">
            <form class="d-none d-sm-inline-block form-inline  my-2 my-md-0 mw-100 navbar-search"
                  id="userFormSearch">
                <div class="input-group border-left-primary">
                    <input type="text" class="form-control bg-light border-0 small user-searchkey"
                           placeholder="Tìm kiếm..."
                           aria-label="Search" aria-describedby="basic-addon2" name="searchKey">
                </div>
            </form>
            <div class="show_search_result d-flex align-items-center">
                <p id="row_number_serach" class="text-danger mt-3"></p>
                <div class="select_row">
                </div>
            </div>
            <p class="search-message text-danger ml-1"></p>
        </div>

        <div class="col-12">
            <table class="table table-responsive" id="table_data">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th>Email</th>
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
                        <td>
                            {{$user->email}}
                        </td>
                        <td class="d-flex">
                            <a class="btn btn-outline-primary btn-circle" title="Cập nhật sinh viên"
                               href=" {{route('students.edit',$user->id)}}">
                                <i class="fa fa-edit text-dark"></i>
                            </a>
                            <button class="btn btn-outline-dark delete-user btn-circle" title="Xóa người dùng"
                                    deleteId="{{$user->id}}"><i class="fas fa-trash text-danger"></i></button>
                            <button class="btn btn-outline-success btn-circle  show-user" title="Chi tiết người dùng"
                                    data-toggle="modal"
                                    showId="{{$user->id}}"
                                    data-target="#showUserModal">
                                <i class="fas fa-info-circle text-primary"></i></button>
                            <button class="btn btn-outline-primary btn-circle  show-user" title="Đổi mật khẩu"
                                    data-toggle="modal"
                                    showId="{{$user->id}}"
                                    data-target="#showUserModal">
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
                                        <input type="file" class="form-control " name="image" id="image-input"
                                        >
                                        <span class="text-danger error-image"></span>
                                    </div>
                                    <div>
                                        <img src="" alt="" width="100px" height="100px"
                                             style="max-height: 100%;max-width: 100%" id="image-show">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="">Quyền</label>
                                    <select class="form-control " name="role">
                                        <option value=" " selected>---- Chọn quyền ----</option>
                                        <option value="0" {{old('role')==0?'selected':''}}>Người dùng</option>
                                        <option value="1" {{old('role')==1?'selected':''}} >Nhân viên</option>
                                        <option value="1" {{old('role')==2?'selected':''}} >Quản trị</option>
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
    </div>
@endsection
