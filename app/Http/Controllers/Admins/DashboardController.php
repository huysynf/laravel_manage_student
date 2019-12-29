<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $userCount=User::count();
        $studentCount=Student::count();
        $classroomCount=Classroom::count();
        $subjectCount=Subject::count();
        $facultyCount=Faculty::count();
        return view('backends.dashboard',compact('userCount','studentCount','classroomCount','subjectCount','facultyCount'));
    }


}
