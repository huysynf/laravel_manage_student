<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\CreateStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Models\Classroom;
use App\Models\Classroom_student;
use App\Models\Student;
use DB;
use Image;

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

    public function saveimage($image)
    {
        $name = time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save(public_path($this->path_image) . $name);
        return $name;
    }

    public function index()
    {
        $students = $this->student->getpaginate(10);
        return view('backends.students.index', compact('students'));
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
        $image = $request->file('image');
        $name = $this->saveimage($image);
        try {
            DB::beginTransaction();
            $data['image'] = $name;
            $student = Student::create($data);
            $student->classrooms()->sync($classroom_id);
            DB::commit();
            return redirect()->route('students.index')->with('message', 'Tạo mới học sinh thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            unlink($this->path_image . $name);
            return redirect()->route('students.index')->with('message', 'Tạo mới học sinh thất bại' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=$this->student->getstudent($id);
        return response()->json([
            'status' => 200,
            'message' => 'Lấy thông tin sinh viên thành công',
            'data'=>$student,
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
        $student = Student::findOrFail($id);
        $data = $request->except('classrooms');
        $classroom_id = $request->input('classrooms');
        $image = $request->file('image');
        $current_image = $student->image;
        try {
            DB::beginTransaction();
            if (isset($image)) {
                $image_name = $this->saveimage($image);
                $data['image'] = $image_name;
                unlink('images/students/' . $current_image);
            } else {
                $data['image'] = $current_image;
            }
            $student->update($data);
            $student->classrooms()->sync($classroom_id);
            DB::commit();
            return redirect()->route('students.index')->with('message', 'Cập nhật thành công');
        } catch (Exception $x) {
            DB::rollBack();
            return redirect()->route('students.edit')->with('message', 'Có lỗi xảy ra thêm thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student = $this->student->findOrFail($id);
            DB::beginTransaction();
            $current_image = $student->image;
            $student->delete();
            if (file_exists('images/students/' . $current_image)) {
                unlink('images/students/' . $current_image);
            }
            DB::commit();
            return response()->json([
                'status' => 204,
                'message' => 'Xóa sinh viên thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 400,
                'message' => 'Có lỗi xảy ra xóa thất bại',
            ]);
        }
    }


    public function search($search)
    {
        $students = $this->student->search($search);
        return response()->json([
            'satus' => 200,
            'message' => 'Có ' . count($students) . ' kết quả tìm thấy với từ khóa:' . $search,
            'data' => $students,
        ]);

    }
}
