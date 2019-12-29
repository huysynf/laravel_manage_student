<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Http\Requests\Subjects\UpdateSubjectRequest;
use Illuminate\Http\Request;
use App\Repositories\Admins\SubjectRepository;

class SubjectController extends Controller
{
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function index(Request $request)
    {
        $this->authorize('view-subject');
        $subjects = $this->subjectRepository->search($request->only(['name','lesson']));
        return view('backends.subjects.index', compact('subjects'));
    }

    public function store(CreateSubjectRequest $request)
    {
        $data = $request->all();
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới môn học thành công',
            'data'=>$this->subjectRepository->create($data),
        ]);
    }
    public  function  show($id){
        return response()->json([
            'status'=>200,
            'message'=>'Lấy dữ liêu thành công',
            'data'=>$this->subjectRepository->show($id),
        ]);
    }
    public function update(UpdateSubjectRequest $request, $id)
    {
        $data = $request->all();
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin môn học  thành công',
            'data'=>$this->update($data,$id),
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'status' => 200,
            'message' => $this->subjectRepository->destroy($id),
        ]);
    }


}
