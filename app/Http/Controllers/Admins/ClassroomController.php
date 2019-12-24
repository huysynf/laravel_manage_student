<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classrooms\CreateClassroomRequest;
use App\Http\Requests\Classrooms\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Subject;
use DB;
use Illuminate\Http\Request;


class ClassroomController extends Controller
{
    private $classroom;
    private $faculty;
    private $subject;

    public function __construct()
    {
        $this->classroom = new Classroom();
        $this->faculty = new Faculty();
        $this->subject = new Subject();

    }

    public function index(Request $request)
    {
        $subjects = $this->subject->get('name');
        $faculties = $this->faculty->get('name');
        $classroomName = $request->input('name');
        $subjectName = $request->input('subject');
        $facultyName = $request->input('faculty');
        $classrooms = $this->classroom->search($classroomName, $facultyName, $subjectName);

        return view('backends.classrooms.index', compact('classrooms', 'faculties', 'subjects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = $this->faculty->all(['id', 'name']);
        $subjects = $this->subject->all(['id', 'name']);
        return view('backends.classrooms.create', compact('faculties', 'subjects'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClassroomRequest $request)
    {
        $data = $request->all();
        $this->classroom->create($data);
        DB::commit();
        return redirect(route('classrooms.index'))->with('message', 'Thêm mới lớp học thành công');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom=$this->classroom->with('subject')->with('faculty')->findOrFail($id);
        return response()->json([
            'status'=>200,
            'message'=>'Thành công',
            'data'=>$classroom,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = $this->classroom->findOrFail($id);
        $faculties = $this->faculty->all(['id', 'name']);
        $subjects = $this->subject->all(['id', 'name']);
        return view('backends.classrooms.edit', compact('faculties', 'subjects', 'classroom'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, $id)
    {
        $classroom = $this->classroom->findOrFail($id);
        $data = $request->all();
        $classroom->update($data);
        return redirect(route('classrooms.index'))->with('message', 'Cập nhật thông tin lớp học thành công');

    }

    public function destroy($id)
    {
        $this->classroom->destroy($id);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa thành công',
        ]);

    }
}
