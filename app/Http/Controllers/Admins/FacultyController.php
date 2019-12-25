<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculties\CreateFacultyRequest;
use App\Http\Requests\Faculties\UpdateFacultyRequest;
use App\Models\Faculty;

class FacultyController extends Controller
{
    private $faculty;

    public function __construct()
    {
        $this->faculty = new Faculty();
    }

    public function index()
    {
        $faculties = $this->faculty->orderBy('id', 'desc')->paginate(10);
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


    public function destroy($id)
    {
        Faculty::destroy($id);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa khoa thành  công',
        ]);
    }

    public function search($search)
    {

        $faculties = $this->faculty->search($search);
        return response()->json([
            'status' => 200,
            'message' => 'Có ' . count($faculties) . ' kết quả tìm thấy với từ khóa:' . $search,
            'data' => $faculties,
        ]);

    }
}
