@extends('backends.layouts.app')

@section('title','Thêm mới lớp học')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin  lớp học</h1>
        <a href="{{route('classrooms.index')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="Quản lí lớp học" >
            <i class="fas fa-undo fa-sm text-success"></i> Quản lí lớp học
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
    <div class="row">
        <div class="col-12 col-lg-8 col-md-10">
            <form action="{{route('classrooms.update',$classroom->id)}} " method="POST">

                {{Csrf_field()}}
                {{method_field('put')}}

                <div class="form-group">
                    <label for="">Tên lớp</label>
                    <input type="text" class="form-control" name="name" value="{{(old('name')=="")?$classroom->name:old('name')}}" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Tên khoa</label>
                    <select name="faculty_id"  class="form-control classroom-select-faculty">
                        <option value="" selected>--- Chọn tên ngành ---</option>
                        @foreach($faculties as $faculty)
                            <option value="{{$faculty->id}}" {{ ($faculty->id ==$classroom->faculty_id) ? 'selected' : '' }}>{{$faculty->name}}</option>
                        @endforeach
                    </select>
                    @error('faculty_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Tên môn học</label>
                    <select name="subject_id" class="form-control classroom-select-subject">
                        <option value="" selected>--- Chọn môn ---</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}" {{ ($subject->id ==$classroom->subject_id) ? 'selected' : '' }}>{{$subject->name}}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số lượng thành viên</label>
                    <input type="text" class="form-control name" name="member" id="name" value="{{$classroom->member}}"
                           required>
                    @error('member')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mô tả lớp</label>
                    <textarea type="text" class="form-control" name="description" required >{{$classroom->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary " ><i class="fa fa-pencil-alt"></i>Cập nhật thông tin</button>
            </form>
        </div>
    </div>


@endsection
