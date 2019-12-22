@extends('backends.layouts.app')

@section('title',' Quản lý nghành học')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lý khoa</h1>
        <button type="button" class="ml-2 btn btn-sm btn-primary shadow-sm add-faculty"
                title="Thêm mới khoa" data-toggle="modal" data-target="#newfacultyModal">
            <i class="fas fa-plus fa-sm text-dark"></i> Thêm mới khoa
        </button>
    </div>
    {{--    table data--}}
    <div class="row " id="faculty">
        <div class="col-12 d-flex">
            <form method="get" action="{{route('faculty.search')}}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="searchKey">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="show_search_result d-flex align-items-center">

            </div>
            <p class="search-message text-danger ml-1"></p>
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
                            <button class="btn btn-primary edit-faculty" title="Cập nhật thông tin khoa"
                                    editId="{{$faculty->id}}"
                                    data-toggle="modal"
                                    data-target="#editModal"
                                    data-name="{{$faculty->name}}"
                                    data-description="{{$faculty->description}}"
                                    data-id="{{$faculty->id}}"
                            ><i
                                    class="fa fa-edit text-white"></i>
                            </button>
                            <button class="btn btn-dark delete-faculty" title="Xóa nhật khoa"
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
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
             aria-labelledby="facultyModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facultyModalTitle">Cập nhật thông tin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" class="editfaculty-form">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.faculties.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="button" class="btn btn-primary update-faculty" id="newfaculty">
                                <i class="fa fa-file-alt"></i>Cập nhật thông tin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newfacultyModal" tabindex="-1" role="dialog" aria-labelledby="newfacultyModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newfacultyModalTitle">Thêm mới khoa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('faculties.store')}}" method="post" class="newfaculty-form">
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
