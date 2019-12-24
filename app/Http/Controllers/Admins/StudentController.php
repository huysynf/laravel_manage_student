<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\CreateStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Classroom_student;
use App\Models\Student;
use DB;
use Image;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $student;
    private $classroom;
    private $path_image;
    private $classroom_student;

    public function __construct()
    {
        $this->classroom = new Classroom();
        $this->student = new Student();
        $this->path_image = 'images/students/';
        $this->classroom_student = new Classroom_student();
    }

    public function index(Request $request)
    {
        $name=$request->input('name');
        $address=$request->input('address');
        $classroomName=$request->input('classroom');
        $students = $this->student->search($name,$address,$classroomName);
        $classrooms=$this->classroom->all();
        return view('backends.students.index', compact('students','classrooms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = $this->classroom->all(['id', 'name']);
        return view('backends.students.create', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudentRequest $request)
    {
        $data = $request->except('classrooms');
        $classroom_id = $request->input('classrooms');
        $data['image'] = $this->student->saveImage($request, $this->imagePath);
        $student = Student::create($data);
        $student->classrooms()->sync($classroom_id);
        return redirect()->route('students.index')->with('message', 'Tạo mới học sinh thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->student->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Lấy thông tin sinh viên thành công',
            'data' => $student,
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->student->findOrFail($id);
        $classrooms = $this->classroom->all(['id', 'name']);
        $listClassroomStudent = $this->classroom_student->getclassroomid($id);
        return view('backends.students.edit', compact('student', 'classrooms', 'listClassroomStudent'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student = $this->student->findOrFail($id);
        $data = $request->except('classrooms');
        $classroom_id = $request->input('classrooms');
        $currentImage = $student->image;
        $data['image'] = $this->student->updateimage($request, $this->imagePath, $currentImage);
        $student->update($data);
        $student->classrooms()->sync($classroom_id);
        return redirect()->route('students.index')->with('message', 'Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = $this->student->findOrFail($id);
        $currentImage = $student->image;
        $student->delete();
        $this->student->deleteImage($currentImage,$this->imagePath);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa sinh viên thành công',
        ]);

    }

}
