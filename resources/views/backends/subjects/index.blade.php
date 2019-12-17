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
            <form class="d-none d-sm-inline-block form-inline  my-2 my-md-0 mw-100 navbar-search"
                  id="subjectFormSearch">
                <div class="input-group border-left-primary">
                    <input type="text" class="form-control bg-light border-0 small subject-searchkey"
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
            <table class="table table-bordered " id="table-subject">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên môn học</th>
                    <th>Mô tả</th>
                    <th>Số tiết</th>
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
                            <button class="btn btn-primary edit-subject" title="Cập nhật thông tin khoa"
                                    editId="{{$subject->id}}"
                                    data-toggle="modal"
                                    data-target="#editSubjectModal"
                                    data-name="{{$subject->name}}"
                                    data-lesson="{{$subject->lesson}}"
                                    data-description="{{$subject->description}}"
                                    data-id="{{$subject->id}}"
                            ><i
                                    class="fa fa-edit text-white"></i>
                            </button>
                            <button class="btn btn-dark delete-subject" title="Xóa nhật khoa"
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
                    <form method="post" class="editsubject-form">
                        @csrf
                        <div class="modal-body text-dark">
                            <div class="form-group">
                                <label for="">Tên môn học</label>
                                <input type="text" class="form-control name" name="name" id="name"
                                       required>
                                <span class="text-danger nameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Số tiết</label>
                                <input type="text" class="form-control lesson" name="lesson" id="lesson"
                                       required>
                                <span class="text-danger lessonError"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả môn học</label>
                                <textarea type="text" class="form-control description" name="description"
                                          id="description"></textarea>
                                <span class="text-danger descriptionError"></span>
                            </div>

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
                        <h5 class="modal-title" id="newSubjectModalTitle">Thêm mới khoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('subjects.store')}}" method="post" class="newsubject-form">
                        @csrf
                        <div class="modal-body text-dark">
                            <div class="form-group">
                                <label for="">Tên môn học</label>
                                <input type="text" class="form-control name" name="name" id="name"
                                       required>
                                <span class="text-danger nameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Số tiết</label>
                                <input type="text" class="form-control lesson" name="lesson" id="lesson"
                                       required>
                                <span class="text-danger lessonError"></span>
                            </div>
                            <div class="form-group">
                                <label for="">Mô tả môn học</label>
                                <textarea type="text" class="form-control description" name="description"
                                          id="description"></textarea>
                                <span class="text-danger descriptionError"></span>
                            </div>

                            <button type="button" class="btn btn-primary new-subject"><i class="fa fa-plus"></i>Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
