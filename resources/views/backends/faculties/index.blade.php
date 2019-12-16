@extends('backends.layouts.app')

@section('title',' Quản lý nghành học')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-sm-around mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý khoa</h1>
        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm addBtnResource"
                title="Thêm mới khoa" data-toggle="modal" data-target="#newfacultyModal">
            <i class="fas fa-plus fa-sm text-dark"></i> Thêm mới khoa
        </button>
    </div>
    {{--    table data--}}
    <div class="row">
        <div class="col-12 mb-3">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                  id="facultyFormSearch">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small searchkey" placeholder="Tìm kiếm..."
                           aria-label="Search" aria-describedby="basic-addon2" name="searchKey">
                    <div class="input-group-append">
                        <button class="btn btn-primary facultySearch" type="submit">
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
            <table class="table table-hover " id="table_faculty">
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
                            <button class="btn btn-primary editBtnResource" title="Cập nhật thông tin khoa"
                                    editId="{{$faculty->id}}"
                                    data-toggle="modal"
                                    data-target="#editModal"
                                    data-name="{{$faculty->name}}"
                                    data-description="{{$faculty->description}}"
                                    data-id="{{$faculty->id}}"
                            ><i
                                    class="fa fa-edit text-white"></i>
                            </button>
                            <button href="" class="btn btn-dark deleteFaculty" title="Xóa nhật khoa"
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
                    <form method="post" class="editResourceForm">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.faculties.form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Hủy
                            </button>
                            <button type="submit" class="btn btn-primary updateFaculty" id="newfaculty">
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
                    <form action="{{route('faculty.store')}}" method="post" class="newResourceForm">
                        @csrf
                        <div class="modal-body text-dark">
                            @include('backends.faculties.form')
                            <button type="submit" class="btn btn-primary newFaculty"><i class="fa fa-plus"></i>Thêm mới
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
@endsection
