<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\CreateStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;
use Image;
use App\Repositories\Admins\StudentRepository;

class StudentController extends Controller
{
    protected $student;
    protected $classroom;
    protected $imagePath;
    protected $classroom_student;
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository=$studentRepository;
        $this->classroom = new Classroom();
        $this->student = new Student();
        $this->imagePath = 'images/students/';
        $this->classroom_student = new ClassroomStudent();
    }

    public function index(Request $request)
    {
        $students = $this->studentRepository->search($request->only(['name','address','classrooms']));
        return view('backends.students.index')->with(['students'=>$students['students'], 'classrooms'=>$students['classrooms']]);

    }

    public function create()
    {
        $classrooms = $this->classroom->all(['id', 'name']);
        return view('backends.students.create', compact('classrooms'));
    }

    public function store(CreateStudentRequest $request)
    {
        $this->studentRepository->store($request->all());
        return redirect()->route('students.index')->with('message', 'Tạo mới học sinh thành công');

    }

    public function show($id)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Lấy thông tin sinh viên thành công',
            'data' => $this->student->findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        $data=$this->studentRepository->edit($id);
        return view('backends.students.edit')->with(['student'=>$data['student'], 'classrooms'=>$data['classrooms'], 'listClassroomStudent'=>$data['listClassroomId']]);

    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $this->studentRepository->update($request->all(),$id);
        return redirect()->route('students.index')->with('message', 'Cập nhật thành công');

    }

    public function destroy($id)
    {
        return response()->json([
            'status' => 204,
            'message' => $this->studentRepository->destroy($id),
        ]);
    }
}
