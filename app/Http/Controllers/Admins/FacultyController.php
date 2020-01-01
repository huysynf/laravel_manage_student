<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculties\CreateFacultyRequest;
use App\Http\Requests\Faculties\UpdateFacultyRequest;
use App\Repositories\Admins\FacultyRepository;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepository $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    public function index(Request $request)
    {
        $data = $request->only(['name', 'lesson']);
        $faculties = $this->facultyRepository->search($data);
        return view('backends.faculties.index', compact('faculties'));
    }

    public function store(CreateFacultyRequest $request)
    {
        $faculty = $this->facultyRepository->create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới thành công',
            'data' => $faculty,
        ]);
    }

    public function update(UpdateFacultyRequest $request, $id)
    {
        $faculty = $this->facultyRepository->update($request->all(), $id);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin khoa  thành công',
            'data' => $faculty,
        ]);
    }

    public function show($id)
    {
        $faculty = $this->facultyRepository->show($id);
        return response()->json([
            'status' => 200,
            'message' => 'Thành công',
            'data' => $faculty,
        ]);
    }

    public function destroy($id)
    {
        $message = $this->facultyRepository->destroy($id);
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }


}
