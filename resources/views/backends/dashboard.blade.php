@extends('backends.layouts.app')

@section('title',' dashboard')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Người dùng</div>
                            <div class="h5 mb-0 font-weight-bold text-primary counter" data-count="{{$userCount}}">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sinh viên</div>
                            <div class="h5 mb-0 font-weight-bold text-success counter" data-count="{{$studentCount}}">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Lớp học</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-info counter" data-count="{{$classroomCount}}">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Môn học</div>
                            <div class="h5 mb-0 font-weight-bold text-warning counter" data-count="{{$subjectCount}}">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Khoa</div>
                            <div class="h5 mb-0 font-weight-bold text-danger counter" data-count="{{$facultyCount}}">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
