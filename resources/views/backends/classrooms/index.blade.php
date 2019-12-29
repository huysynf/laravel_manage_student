@extends('backends.layouts.app')

@section('title',' Quản lý lớp học')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí lớp học</h1>
        <a href="{{route('classrooms.create')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="thêm mới lớp học">
            <i class="fas fa-plus fa-sm text-success"></i> Thêm mới lớp học
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
    <div class="row" id="classroom">
        <div class="col-12 d-flex">
            <form method="get" action="{{route('classrooms.index')}}" class=" p-1 d-flex"
                  id="subjectFormSearch">
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên Lớp tìm kiếm</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm..." name="name"  >
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="role" >Tên khoa</lable>
                    <select name="faculty" class="h-50 classroom-select-faculty">
                        <option value="">Tất cả</option>
                        @foreach($faculties as $faculty)
                            <option value="{{$faculty->name}}" {{(request()->input('faculty')==$faculty->name)?'selected':''}}  >{{$faculty->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="role" >Tên môn học</lable>
                    <select name="subject" class="h-50 classroom-select-subject">
                        <option value="">Tất cả</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->name}}" {{(request()->input('subject')==$subject->name)?'selected':''}}  >{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="align-self-end ml-1">
                    <button class="btn btn-primary  aqua-gradient btn-rounded btn-sm my-0" type="submit" title="Tìm kiếm">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12">
            <table class="table table-hover " id="table_data">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên lớp</th>
                    <th>Thành viên</th>
                    <th>Mô tả</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classrooms as $classroom)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            {{$classroom->name}}
                        </td>
                        <td>
                            {{$classroom->member}}
                        </td>
                        <td>{{$classroom->description}}</td>
                        <td>
                            <a class="btn btn-outline-primary btn-circle " title="Cập nhật lớp  học"
                               href=" {{route('classrooms.edit',$classroom->id)}}">
                                <i class="fa fa-edit text-dark"></i>
                            </a>
                            <button class="btn btn-outline-dark btn-circle delete-classroom" title="Xóa lớp học"
                                    deleteId="{{$classroom->id}}"><i class="fas fa-trash text-danger"></i></button>
                            <button class="btn btn-outline-success btn-circle  show-classroom" title="chi tiết lớp học"
                                    data-toggle="modal"
                                    showId="{{$classroom->id}}"
                                    data-target="#showClassroomModal">
                                <i class="fas fa-info-circle text-primary"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {!! $classrooms->links() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="showClassroomModal" tabindex="-1" role="dialog"
         aria-labelledby="showClassroomModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="howClassroomModalTitle">Thông tin lớp <span class="classromm-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark">
                    <p> Tên lớp : <span class="classroom-name"></span></p>
                    <p> Số sinh viên : <span class="classroom-member"></span></p>
                    <p> Mô tả : <span class="classroom-description"></span></p>
                    <p>Tên môn học ở lớp:<span class="classroom-subject"></span></p>
                    <p>Tên khoa:<span class="classroom-faculty"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Trở về</button>
                </div>
            </div>
        </div>
    </div>
@endsection

