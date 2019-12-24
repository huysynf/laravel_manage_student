<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculties\CreateFacultyRequest;
use App\Http\Requests\Faculties\UpdateFacultyRequest;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    private $faculty;

    public function __construct()
    {
        $this->faculty = new Faculty();
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $faculties = $this->faculty->search($name, $description);
        return view('backends.faculties.index', compact('faculties'));
    }

    public function store(CreateFacultyRequest $request)
    {
        $data = $request->all();
        $this->faculty->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới thành công',
        ]);
    }

    public function update(UpdateFacultyRequest $request, $id)
    {
        $faculty = $this->faculty->findOrFail($id);
        $data = $request->all();
        $faculty->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin khoa  thành công',
        ]);
    }

    public function show($id)
    {
        $faculty = $this->faculty->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Thành công',
            'data' => $faculty,
        ]);
    }

    public function destroy($id)
    {
        $this->faculty->destroy($id);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa khoa thành  công',
        ]);
    }


}
