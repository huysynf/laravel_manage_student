<?php

namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use App\Http\Requests\Subjects\CreateSubjectRequest;
use App\Http\Requests\Subjects\UpdateSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    private $subject;

    public function __construct()
    {
        $this->subject = new Subject();
    }

    public function index(Request $request)
    {
        $name = $request->input('name');
        $lesson = $request->input('lesson');
        $subjects = $this->subject->search($name, $lesson);
        return view('backends.subjects.index', compact('subjects'));
    }

    public function store(CreateSubjectRequest $request)
    {
        $data = $request->all();
       $subject=$this->subject->create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới môn học thành công',
            'data'=>$subject,
        ]);
    }
    public  function  show($id){
        $subject=$this->subject->findOrFail($id);
        return response()->json([
            'status'=>200,
            'message'=>'Lấy dữ liêu thành công',
            'data'=>$subject,
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
            'data'=>$subject,
        ]);
    }

    public function destroy($id)
    {
        $this->subject->destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Xóa môn học thành  công',
        ]);
    }


}
