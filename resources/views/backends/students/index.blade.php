@extends('backends.layouts.app')

@section('title',' Quản lý sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí sinh viên</h1>
        <a href="{{route('students.index')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
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
    <div class="col-12 mb-3">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
              id="facultyFormSearch">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small searchkey" placeholder="Tìm kiếm..."
                       aria-label="Search" aria-describedby="basic-addon2" name="searchKey">
                <div class="input-group-append">
                    <button class="btn btn-primary userSearch" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <p class="text-danger error_search"></p>
        </form>
        <div class="show_search_result d-flex align-items-center">
            <p id="row_number_serach" class="text-danger mt-3"></p>
            <div class="select_row">
            </div>
        </div>
    </div>
    <div class="col-12">
        <table class="table table-hover " id="table_data">
            <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
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
                    <td>
                        <a class="btn btn-primary " title="Cập nhật sinh viên"
                           href=" {{route('students.edit',$student->id)}}">
                            <i class="fa fa-edit text-white"></i>
                        </a>
                        <button class="btn btn-dark delete-student" title="Xóa sinh viên"
                                deleteId="{{$student->id}}"><i class="fas fa-trash text-danger"></i></button>
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
@endsection
