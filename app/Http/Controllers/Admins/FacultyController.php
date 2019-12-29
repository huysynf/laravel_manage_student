<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculties\CreateFacultyRequest;
use App\Http\Requests\Faculties\UpdateFacultyRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Repositories\Admins\FacultyRepository;

class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepository $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('view-faculty');
        $data=$request->only(['name','lesson']);
        $faculties = $this->facultyRepository->search($data);
        return view('backends.faculties.index', compact('faculties'));
    }

    public function store(CreateFacultyRequest $request)
    {

        $data = $request->all();
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới thành công',
            'data'=> $this->facultyRepository->create($data),
        ]);
    }

    public function update(UpdateFacultyRequest $request, $id)
    {

        $data = $request->all();

        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin khoa  thành công',
            'data'=>$this->facultyRepository->update($data,$id),
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'status' => 200,
            'message' => 'Thành công',
            'data' => $this->facultyRepository->show($id),
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'status' => 200,
            'message' => $this->facultyRepository->destroy($id),
        ]);
    }


}
