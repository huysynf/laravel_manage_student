<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomSchedule;
use Illuminate\Http\Request;



class ClassroomScheduleController extends Controller
{
    protected $classroom;
    protected $classroomSchedule;

    public function __construct()
    {
        $this->classroom=new Classroom();
        $this->classroomSchedule=new ClassroomSchedule();
    }

    public function create($id){
        $classroom=$this->classroom->findOrFail($id);

        return view('backends.classrooms.classroom_schedule',compact('classroom'));
    }
    public function store(Request $request,$id){
        $data=$request->all();
        $flag=$this->classroomSchedule->checkDayTimeClassroom($data);
        if(!$flag){
            $this->classroomSchedule->create($data);
            return redirect()->route('classroomchedules.create',$id)->with('massage','Tạo lịch cho lớp học  thành công!');

        }else{
            return redirect()->route('classroomchedules.create',$id)->with('massage','Lich  này đã có !');
        }
    }

    public function destroy($id){

    }


}
