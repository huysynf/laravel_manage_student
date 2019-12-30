@extends('backends.layouts.app')

@section('title','Lỗi 403')

@section('content')
    <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Bạn không có quyền</p>
        <p class="text-gray-500 mb-0">Trang này không tồn tại</p>
    </div>
@endsection
