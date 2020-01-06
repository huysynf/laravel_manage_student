<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Repositories\Admins\ClassroomScheduleRepository;
use Illuminate\Http\Request;

class ClassroomScheduleController extends Controller
{
    protected $classroomScheduleRepository;

    public function __construct(ClassroomScheduleRepository $classroomScheduleRepository)
    {
        $this->classroomScheduleRepository = $classroomScheduleRepository;
    }

    public function create($id)
    {
        $data = $this->classroomScheduleRepository->create($id);

        return view('backends.classrooms.classroom_schedule')->with([
            'classroom' => $data['classroom'],
            'classroomSchedule' => $data['classroomSchedule'],
            'row' => $data['row'],
            'col' => $data['col'],
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $message = $this->classroomScheduleRepository->store($data);

        return redirect()->route('classroomchedules.create', $id)->with('massage', $message);
    }

    public function destroy($id)
    {
        $message = $this->classroomScheduleRepository->destroy($id);

        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }

}
