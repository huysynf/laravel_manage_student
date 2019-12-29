@extends('backends.layouts.app')

@section('title',' Quản lý sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí sinh viên</h1>
        @can('create-student')
            <a href="{{route('students.create')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
               title="thêm mới sinh viên">
                <i class="fas fa-plus fa-sm text-success"></i> thêm mới sinh viên
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
    <div class="row" id="student">
        <div class="col-12 d-flex">
            <form method="get" action="{{route('students.index')}}" class=" p-1 d-flex"
                  id="subjectFormSearch">
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên tìm kiếm</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm..."
                           name="name">
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="address">Địa chỉ</lable>
                    <input value="{{request()->input('address')}}" class="h-50" type="text"
                           placeholder="Địa chỉ tìm kiếm..." name="address">
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="role">Tên lớp</lable>
                    <select name="classroom" class="h-50 student-select-classroom">
                        <option value="">Tất cả</option>
                        @foreach($classrooms as $classroom)
                            <option
                                value="{{$classroom->name}}" {{(request()->input('classroom')==$classroom->name)?'selected':''}} >{{$classroom->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="align-self-end ml-1">
                    <button class="btn btn-primary  aqua-gradient btn-rounded btn-sm my-0" type="submit"
                            title="Tìm kiếm">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>

            </form>
        </div>

        <div class="col-12">
            <table class="table table-bordered " id="table_data">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Số điện thoại</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            <img src="{{asset('images/students/'.$student->image)}}" alt=""
                                 style="max-width: 50px;max-height: 50px;" width="100%" height="100%"
                                 alt="{{$student->name}}">
                        </td>
                        <td>
                            {{$student->name}}
                        </td>
                        <td>
                            {{$student->birthday}}
                        </td>
                        <td>
                            {{($student->gender ==1)?'Nam':'Nữ'}}
                        </td>
                        <td>{{$student->phone}}</td>
                        <td>
                            @can('edit-student')
                                <a class="btn btn-outline-primary btn-circle" title="Cập nhật sinh viên"
                                   href=" {{route('students.edit',$student->id)}}">
                                    <i class="fa fa-edit text-dark"></i>
                                </a>
                            @endcan
                            @can('destroy-student')
                                <button class="btn btn-outline-dark delete-student btn-circle" title="Xóa sinh viên"
                                        deleteId="{{$student->id}}"><i class="fas fa-trash text-danger"></i></button>
                            @endcan
                            <button class="btn btn-outline-success btn-circle  show-student" title="chi tiết sinh v"
                                    data-toggle="modal"
                                    showId="{{$student->id}}"
                                    data-target="#showStudentModal">
                                <i class="fas fa-info-circle text-primary"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {{ $students->links() }}

            </div>
        </div>
        <div class="modal fade" id="showStudentModal" tabindex="-1" role="dialog"
             aria-labelledby="showStudentModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showStudentModalTitle">Thông tin sinh viên <span
                                class="classromm-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-dark ">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p> Tên sinh viên: <span class="student-name"></span></p>
                                <p> Gới tính: <span class="student-gender"></span></p>
                                <p> Ngày sinh: <span class="student-birthday"></span></p>
                            </div>
                            <div>
                                <img src="" alt="" class="student-image" width="100%" height="100%"
                                     style="max-width: 100px;max-height: 100px;">
                            </div>
                        </div>
                        <p> Số điện thoại : <span class="student-phone"></span></p>
                        <p> Địa chỉ: <span class="student-address"></span></p>
                        <div class="d-flex">
                            <p>Các lớp học:</p>
                            <div class="student-classroom flex-column align-items-center pl-3">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
