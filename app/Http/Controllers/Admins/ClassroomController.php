<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Classrooms\CreateClassroomRequest;
use App\Http\Requests\Classrooms\UpdateClassroomRequest;
use App\Repositories\Admins\ClassroomRepository;
use DB;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    protected $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    public function index(Request $request)
    {
        $data = $this->classroomRepository->search($request->only(['name', 'subject', 'faculty']));
        return view('backends.classrooms.index')->with([
            'classrooms' => $data['classrooms'],
            'faculties' => $data['faculty'],
            'subjects' => $data['subject']
        ]);
    }

    public function create()
    {
        $data = $this->classroomRepository->create();
        return view('backends.classrooms.create')->with([
            'faculties' => $data['faculty'],
            'subjects' => $data['subject']
        ]);
    }

    public function store(CreateClassroomRequest $request)
    {
        $this->classroomRepository->store($request->all());
        return redirect(route('classrooms.index'))->with('message', 'Thêm mới lớp học thành công');
    }

    public function show($id)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Thành công',
            'data' => $this->classroomRepository->show($id),
        ]);
    }

    public function edit($id)
    {
        $data = $this->classroomRepository->edit($id);
        return view('backends.classrooms.edit')->with([
            'faculties' => $data['faculty'],
            'subjects' => $data['subject'],
            'classroom' => $data['classroom']
        ]);
    }

    public function update(UpdateClassroomRequest $request, $id)
    {
        $this->classroomRepository->update($request->all(), $id);
        return redirect(route('classrooms.index'))->with('message', 'Cập nhật thông tin lớp học thành công');
    }

    public function destroy($id)
    {
        return response()->json([
            'status' => 204,
            'message' => $this->classroomRepository->destroy($id),
        ]);
    }
}
