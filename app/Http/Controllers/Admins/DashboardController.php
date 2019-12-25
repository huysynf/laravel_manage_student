<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
