<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Faculty;

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
