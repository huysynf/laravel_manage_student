@extends('backends.layouts.app')

@section('title','Sửa sinh sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Cập nhật thông tin sinh viên</h1>
        <a href="{{route('classrooms.index')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="Quản lí sinh viên">
            <i class="fas fa-undo fa-sm text-success"></i> Quản lí sinh viên
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

            <form action="{{route('students.update',$student->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('put')}}

                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Tên sinh viên</label>
                        <input type="text" class="form-control" name="name" value="{{$student->name}}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Ngày sinh </label>
                        <input type="date" class="form-control name" name="birthday" value="{{$student->birthday}}"
                        >
                        @error('birthday')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Ảnh </label>

                        <input type="file" class="form-control name" name="image"
                        >
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm 12 image__wrap">
                        <a href=""><img src="{{asset('images/students/'.$student->image)}}" alt="" width="100%" height="100%" style="max-height:100px;max-width:100px;"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Tên lớp</label>
                        <select name="classrooms[]" id="" class="form-control student-select-classroom" multiple>
                            @foreach($classrooms as $classroom)
                                <option
                                    value="{{$classroom->id}}" {{( $listClassroomStudent->contains($classroom->id)) ? 'selected' : '' }}  {{in_array($classroom->id,old('classrooms',[]))? 'selected' : '' }}>{{$classroom->name}}</option>
                            @endforeach
                        </select>
                        @error('classrooms')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control name" name="phone" value="{{$student->phone}}"
                               required>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 col-lg-6 col-sm-12">
                        <label for="">Giới tính</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="1" {{($student->gender==1)?"checked="."checked":""}}>
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="0" {{($student->gender==0)?"checked="."checked":""}}>
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                        </div>
                        @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12 col-lg-6 col-sm-12">
                        <label for="">Địa chỉ</label>
                        <textarea type="text" class="form-control" name="address" required>{{$student->address}}</textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary "><i class="fa fa-plus"></i>Cập nhật thông tin</button>
            </form>
        </div>
    </div>


@endsection
