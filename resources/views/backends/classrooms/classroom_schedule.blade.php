@extends('backends.layouts.app')

@section('title',' Quản lý lịch lớp')

@section('content')

    <div class="d-sm-flex align-items-center mb-2">
        <h1 class="h3 mb-0 text-gray-800">Quản lí lịch lớp học: {{$classroom->name}}</h1>
        <a href="{{route('classrooms.index')}}" class="ml-2 btn btn-sm btn-primary shadow-sm "
           title="quản lí lớp học">
            <i class="fas fa-undo fa-sm text-success"></i> Quay lại trang quản lí lóp
        </a>
    </div>
    @if(session('massage'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{session('massage')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{--    table data--}}
    <div class="row" id="student">
        <div class="col-12 d-flex">
            <form method="post" action="{{route('classroomchedules.store',$classroom->id)}}" class=" p-1 d-flex border"
            >
                @csrf
                <input type="hidden" name="classroom_id" value="{{$classroom->id}}">
                <div class="d-flex flex-column">
                    <label>Ca trong ngày</label>
                    <select name="time" class="form-control">
                        @for($i=1;$i<=4;$i++)
                            <option value="{{$i}}">Ca {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="d-flex flex-column ml-1">
                    <label>Ngày học trong tuần</label>
                    <select name="day" class="form-control">
                        @for($i=2;$i<=7;$i++)
                            <option value="{{$i}}">Thứ {{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="align-self-end ml-1">
                    <button type="submit" class="btn btn-primary" title="thêm mới lịch lớp học"><i class="fa fa-plus"></i></button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <h4>Lịch  của lớp: {{$classroom->name}}</h4>
            <table class=" table table-bordered">
                <tr>
                    <td>Ca/Thứ</td>
                    @for($i=2;$i<=7;$i++)
                        <th >Thứ {{$i}}</th>
                    @endfor
                </tr>
                @for($i=1;$i<=4;$i++)
                    <tr>
                        <td>Ca{{$i}}</td>
                        @for($j=2;$j<=7;$j++)
                            <td>
                                @foreach($classroom->classroomShedule as $classroomSchedule)
                                    @if($classroomSchedule->day==$j && $classroomSchedule->time==$i)
                                        <i class="fa fa-check text-primary"></i>
                                        {{$classroomSchedule->id}}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                        @endfor

                    </tr>
                @endfor
            </table>
        </div>
    </div>
@endsection

