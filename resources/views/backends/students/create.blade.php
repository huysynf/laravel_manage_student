@extends('backends.layouts.app')

@section('title','Thêm mới sinh viên')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới sinh viên</h1>
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
            <form action="{{route('students.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Tên sinh viên</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Ngày sinh </label>
                        <input type="date" class="form-control name" name="birthday" value="{{old('birthday')}}"
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
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Tên lớp</label>
                        <select name="classrooms[]" id="" class="form-control" multiple>
                            @foreach($classrooms as $classroom)
                                <option
                                    value="{{$classroom->id}}"  {{in_array($classroom->id,old('classrooms',[]))? 'selected' : '' }}>{{$classroom->name}}</option>
                            @endforeach
                        </select>
                        @error('classrooms')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-sm-12">
                        <label for="">Số điện thoại</label>
                        <input type="text" class="form-control name" name="phone" value="{{old('phone')}}"
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
                                   value="1" {{(old('gender')==1)?"checked="."checked":""}}>
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="0" {{(old('gender')==0)?"checked="."checked":""}}>
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                        </div>
                        @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12 col-lg-6 col-sm-12">
                        <label for="">Địa chỉ</label>
                        <textarea type="text" class="form-control" name="address" required>{{old('address')}}</textarea>
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary "><i class="fa fa-plus"></i>Thêm mới</button>
            </form>
        </div>
    </div>


@endsection
