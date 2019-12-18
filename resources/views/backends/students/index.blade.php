@extends('backends.layouts.app')

@section('title',' Quản lý sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí sinh viên</h1>
        <a href="{{route('students.create')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="thêm mới sinh viên">
            <i class="fas fa-plus fa-sm text-success"></i> thêm mới sinh viên
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
    <div class="row" id="student">
        <div class="col-12 d-flex">
            <form class="d-none d-sm-inline-block form-inline  my-2 my-md-0 mw-100 navbar-search"
                  id="studentFormSearch">
                <div class="input-group border-left-primary">
                    <input type="text" class="form-control bg-light border-0 small student-searchkey"
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
                            <a class="btn btn-outline-primary btn-circle" title="Cập nhật sinh viên"
                               href=" {{route('students.edit',$student->id)}}">
                                <i class="fa fa-edit text-dark"></i>
                            </a>
                            <button class="btn btn-outline-dark delete-student btn-circle" title="Xóa sinh viên"
                                    deleteId="{{$student->id}}"><i class="fas fa-trash text-danger"></i></button>
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
