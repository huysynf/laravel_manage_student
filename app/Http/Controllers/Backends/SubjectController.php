<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Http\Requests\Subjects\UpdateSubjectRequest;
use App\Models\Subject;

class SubjectController extends Controller
{
    private $subject;

    public function __construct()
    {
        $this->subject = new Subject();
    }

    public function index()
    {
        $subjects = $this->subject->getpaginate(10);
        return view('backends.subjects.index', compact('subjects'));
    }

    public function store(CreateSubjectRequest $request)
    {
        $data = $request->all();
        $this->subject->create($data);
        return response()->json([
            'status' => 201,
            'message' => 'Thêm mới môn học thành công',
        ]);
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = $this->subject->findOrFail($id);
        $data = $request->all();
        $subject->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin môn học  thành công',
        ]);
    }

    public function destroy($id)
    {
        $this->subject->destroy($id);
        return response()->json([
            'status' => 204,
            'message' => 'Xóa môn học thành  công',
        ]);
    }

    public function search($search)
    {

        $subjects = $this->subject->search($search);
        return response()->json([
            'status' => 200,
            'message' => 'Có ' . count($subjects) . ' kết quả tìm thấy với từ khóa mon:' . $search,
            'data' => $subjects,
        ]);

    }
}
