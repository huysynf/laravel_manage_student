@extends('backends.layouts.app')

@section('title',' Quản lý môn học')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lý môn học</h1>
        <button type="button" class="ml-2 btn btn-sm btn-primary shadow-sm add-subject"
                title="Thêm mới môn học" data-toggle="modal" data-target="#newsubjectModal">
            <i class="fas fa-plus fa-sm text-dark"></i> Thêm mới môn học
        </button>
    </div>
    {{--    table data--}}
    <div class="row " id="subject">
        <div class="col-12 d-flex">
            <form method="get" action="{{route('subjects.index')}}" class=" p-1 d-flex"
                  id="subjectFormSearch">
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên môn học</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm..." name="name"  >
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="lesson">Số tiết</lable>
                    <input value="{{request()->input('lesson')}}" class="h-50" type="text" placeholder="Số tiết tìm kiếm..." name="lesson"  >
                </div>
                <div class="align-self-end ml-1">
                    <button class="btn btn-primary  aqua-gradient btn-rounded btn-sm my-0" type="submit" title="Tìm kiếm">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>

            </form>
        </div>
        <div class="col-12">
            <table class="table table-bordered " id="table-subject">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên môn học</th>
                    <th>Số tiết</th>
                    <th>Mô tả</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            {{$subject->name}}
                        </td>
                        <td>
                            {{$subject->lesson}}
                        </td>
                        <td>{{$subject->description}}</td>
                        <td>
                            <button class="btn btn-outline-primary edit-subject btn-circle"
                                    title="Cập nhật thông tin khoa"
                                    editId="{{$subject->id}}"
                                    data-toggle="modal"
                                    data-target="#editSubjectModal"
                                    data-name="{{$subject->name}}"
                                    data-lesson="{{$subject->lesson}}"
                                    data-description="{{$subject->description}}"
                                    data-id="{{$subject->id}}"
                            ><i
                                    class="fa fa-edit text-warning"></i>
                            </button>
                            <button class="btn btn-outline-dark delete-subject btn-circle" title="Xóa nhật khoa"
                                    deleteId="{{$subject->id}}"><i class="fas fa-trash text-danger"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {!! $subjects->links() !!}
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog"
             aria-labelledby="facultyModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facultyModalTitle">Cập nhật thông tin môn học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" class="edit-subject-form">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.subjects.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" class="btn btn-primary update-subject" id="newfaculty">
                                <i class="fa fa-file-alt"></i>Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newsubjectModal" tabindex="-1" role="dialog" aria-labelledby="newsubjectModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newSubjectModalTitle">Thêm mới môn học</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('subjects.store')}}" method="post" class="new-subject-form">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.subjects.form')
                            <button type="button" class="btn btn-primary new-subject"><i class="fa fa-plus"></i>Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
