<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\Http\Requests\Students\CreateStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Repositories\Admins\StudentRepository;
use DB;
use Illuminate\Http\Request;
use Image;

class StudentController extends Controller
{
    protected $classroom;
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->classroom = new Classroom();
    }

    public function index(Request $request)
    {
        $this->authorize('view-student');
        $students = $this->studentRepository->search($request->only(['name', 'address', 'classrooms']));
        return view('backends.students.index')->with([
            'students' => $students['students'],
            'classrooms' => $students['classrooms']
        ]);

    }

    public function create()
    {
        $this->authorize('create-student');
        $classrooms = $this->studentRepository->create();
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
            'data' => $this->studentRepository->show($id),
        ]);
    }

    public function edit($id)
    {
        $this->authorize('edit-student');
        $data = $this->studentRepository->edit($id);
        return view('backends.students.edit')->with([
            'student' => $data['student'],
            'classrooms' => $data['classrooms'],
            'listClassroomStudent' => $data['listClassroomId']
        ]);

    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $this->studentRepository->update($request->all(), $id);
        return redirect()->route('students.index')->with('message', 'Cập nhật thành công');

    }

    public function destroy($id)
    {
        $this->authorize('destroy-student');
        return response()->json([
            'status' => 204,
            'message' => $this->studentRepository->destroy($id),
        ]);
    }

}
