@extends('backends.layouts.app')
@section('title',' Cập nhật nhóm quyền')
@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Câp nhật nhóm quyền</h1>
        <a class="ml-2 btn btn-sm btn-primary shadow-sm " href="{{route('roles.index')}}"
           title="về trang quản lí quyền"
        ><i class="fas fa-plus fa-undo text-success"></i> Quay lại trang quản lí
        </a>
    </div>
    <div class="row">
        <form method="post" id="update-role-form" action="{{route('roles.update',$role->id)}}"
              enctype="multipart/form-data">
            @csrf
            {{method_field('put')}}
            <div class="form-group">
                <label for="">Tên hiện thị</label>
                <input type="text" class="form-control role-name" name="name"
                       value="{{old('name')==""?$role->name:old('name')}}"
                       required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Tên nhóm quyền</label>
                <input type="text" class="form-control role-slug" name="slug"
                       value="{{old('slug')==""?$role->slug:old('slug')}}"
                       required>
                @error('slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="permissions">Quyền</label>
                <div class=" row">
                    <div class="form-check-inline col-4 m-0">
                        <label class="form-check-label pl-4">
                            <input type="checkbox" class="form-check-input   select-all"> Chọn
                            tất cả
                        </label>
                    </div>
                    @foreach($permissions as $key=>$permission)
                        <div class="form-check-inline col-4 m-0">
                            <label class="form-check-label pl-4">
                                @if($permission->slug=="not-permission")
                                    <input type="checkbox" class="form-check-input  un-select-all"
                                           name="permissions[]"
                                           value="{{$permission->id}}" {{(in_array($permission->id,$listPermission)) ? 'checked=checked' : '' }}>{{$permission->name}}
                                @else
                                    <input type="checkbox" class="form-check-input   select-item"
                                           name="permissions[]"
                                           {{ in_array($permission->id,$listPermission) ? 'checked=checked' : '' }}
                                           value="{{$permission->id}}">{{$permission->name}}
                                @endif
                            </label>
                        </div>
                    @endforeach
                    <span class="text-danger error-permissions"></span>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-outline-primary update-role"><i
                        class="fas fa-pencil-alt">
                        Cập nhật thông tin
                    </i>
                </button>
            </div>

        </form>
    </div>
@endsection
