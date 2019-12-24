@extends('backends.layouts.app')

@section('title',' Quản lý Khoa')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lý khoa</h1>
        <button type="button" class="ml-2 btn btn-sm btn-primary shadow-sm add-faculty"
                title="Thêm mới khoa" data-toggle="modal" data-target="#newFacultyModal">
            <i class="fas fa-plus fa-sm text-dark"></i> Thêm mới khoa
        </button>
    </div>
    {{--    table data--}}
    <div class="row " id="faculty">
        <div class="col-12 d-flex">
            <form method="get" action="{{route('faculties.index')}}" class=" p-1 d-flex"
                  id="subjectFormSearch">
                <div class="d-flex flex-column">
                    <lable class="text-primary" for="name">Tên khoa</lable>
                    <input value="{{request()->input('name')}}" class="h-50" type="text" placeholder="Tên tìm kiếm..."
                           name="name">
                </div>
                <div class="d-flex flex-column ml-1">
                    <lable class="text-primary" for="description">Số tiết</lable>
                    <input value="{{request()->input('description')}}" class="h-50" type="text"
                           placeholder="Mô tả tìm kiếm..." name="description">
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
            <table class="table table-bordered " id="table-faculty">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên khoa</th>
                    <th>Mô tả</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @foreach($faculties as $faculty)
                    <tr>
                        <td>
                            <strong></strong>
                        </td>
                        <td>
                            {{$faculty->name}}
                        </td>
                        <td>{{$faculty->description}}</td>
                        <td>
                            <button class="btn btn-outline-primary btn-circle edit-faculty"
                                    title="Cập nhật thông tin khoa"
                                    editId="{{$faculty->id}}"
                                    data-toggle="modal"
                                    data-target="#editFacultyModal"
                            ><i class="fa fa-edit text-warning"></i>
                            </button>
                            <button class="btn btn-outline-dark delete-faculty btn-circle" title="Xóa nhật khoa"
                                    deleteId="{{$faculty->id}}"><i class="fas fa-trash text-danger"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <div class='pagination-container'>
                {!! $faculties->links() !!}
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="editFacultyModal" tabindex="-1" role="dialog"
             aria-labelledby="editFacultyModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFacultyModalTitle">Cập nhật thông tin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" class="edit-faculty-form">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.faculties.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" class="btn btn-primary update-faculty">
                                <i class="fa fa-file-alt"></i>Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newFacultyModal" tabindex="-1" role="dialog" aria-labelledby="newFacultyModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newfacultyModalTitle">Thêm mới khoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('faculties.store')}}" method="post" class="new-faculty-form">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.faculties.form')
                            <button type="button" class="btn btn-primary new-faculty"><i class="fa fa-plus"></i>Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
