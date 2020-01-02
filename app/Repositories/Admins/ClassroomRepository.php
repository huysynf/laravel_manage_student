<?php

namespace App\Repositories\Admins;

use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Subject;
use App\Repositories\BaseRepository;
use DB;
use Hash;
use Image;

class ClassroomRepository extends BaseRepository
{
    protected $faculty;
    protected $subject;

    public function __construct(Classroom $model)
    {
        $this->model = $model;
        $this->faculty = new Faculty();
        $this->subject = new Subject();
    }

    public function search(array $data)
    {
        $classroom['subject'] = $this->subject->get('name');
        $classroom['faculty'] = $this->faculty->get('name');
        $classroom['classrooms'] = $this->model->search($data);
        return $classroom;
    }

    public function store(array $data)
    {
        $this->model->create($data);
    }

    public function create()
    {
        $data['faculty'] = $this->faculty->all(['id', 'name']);
        $data['subject'] = $this->subject->all(['id', 'name']);
        return $data;
    }

    public function edit($id)
    {

        $data = $this->create();
        $data['classroom'] = $this->model->findOrFail($id);
        return $data;
    }

    public function update(array $data, $id)
    {
        $classroom = $this->model->findOrFail($id);
        $classroom->update($data);
    }

    public function show($id)
    {

        return $this->model->findOrFail($id);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);
        return 'Xóa khoa thành  công';
    }
}
