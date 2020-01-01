<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Http\Requests\Subjects\UpdateSubjectRequest;
use App\Repositories\Admins\SubjectRepository;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index(Request $request)
    {
        $subjects = $this->subjectRepository->search($request->only(['name', 'lesson']));
        return view('backends.subjects.index', compact('subjects'));
    }

    public function store(CreateSubjectRequest $request)
    {
        $subject = $this->subjectRepository->create($request->all());
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới môn học thành công',
            'data' => $subject,
        ]);
    }

    public function show($id)
    {
        $subject = $this->subjectRepository->show($id);
        return response()->json([
            'status' => 200,
            'message' => 'Lấy dữ liêu thành công',
            'data' => $subject,
        ]);
    }

    public function update(UpdateSubjectRequest $request, $id)
    {
        $subject = $this->subjectRepository->update($request->all(), $id);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin môn học  thành công',
            'data' => $subject,
        ]);
    }

    public function destroy($id)
    {
        $message = $this->subjectRepository->destroy($id);
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }


}
