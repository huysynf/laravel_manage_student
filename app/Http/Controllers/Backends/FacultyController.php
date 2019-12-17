<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faculties\CreateFacultyRequest;
use App\Http\Requests\Faculties\UpdateFacultyRequest;
use App\Models\Faculty;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::orderBy('id', 'desc')->paginate(10);
        return view('backends.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFacultyRequest $request)
    {
        $data = $request->all();
        Faculty::create($data);
        return response()->json([
            'status' => 200,
            'message' => 'Thêm mới thành công',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacultyRequest $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        $data = $request->all();
        $faculty->update($data);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật thông tin khoa  thành công',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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

        $searchKey = $search;
        $faculties = Faculty::where('name', 'LIKE', '%' . $searchKey . '%')->orwhere('description', 'LIKE',
            '%' . $searchKey . '%')->get(['id', 'name', 'description']);
        return response()->json([
            'status' => 200,
            'message' => 'Có '.count($faculties).' kết quả tìm thấy với từ khóa:'.$searchKey,
            'data' => $faculties,
        ]);

    }
}
