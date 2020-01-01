<?php

namespace App\Repositories\Admins;

use App\Models\Classroom;
use App\Models\Student;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository
{
    protected $classroom;
    protected $imagePath;

    public function __construct(Student $model)
    {
        $this->model = $model;
        $this->imagePath = 'images/students/';
        $this->classroom = new Classroom();
    }

    public function search(array $data)
    {
        $student['classrooms'] = $this->classroom->all();
        $student['students'] = $this->model->search($data);
        return $student;
    }

    public function store(array $data)
    {
        $classroomIds = $data['classrooms'];
        $image = $data['image'];
        $name = $this->model->saveImage($image, $this->imagePath);
        $data['image'] = $name;
        $student = $this->model->create($data);
        $student->classrooms()->sync($classroomIds);
    }

    public function update(array $data, $id)
    {
        $student = $this->model->findOrFail($id);
        $current_image = $student->image;
        if (isset($data['image'])) {
            $image = $data['image'];
            $data['image'] = $this->model->updateimage($image, $this->imagePath, $current_image);
        } else {
            $data['image'] = $current_image;
        }
        $classroomId = $data['classrooms'];
        $student->update($data);
        $student->classrooms()->sync($classroomId);

    }

    public function edit($id)
    {
        $student['student'] = $this->model->findOrFail($id);
        $student['classrooms'] = $this->classroom->all(['id', 'name']);
        $student['listClassroomId'] = $this->model->getClassroomIdBy($id);
        return $student;
    }

    public function create()
    {
        return $this->classroom->all(['id', 'name']);
    }

    public function show($id)
    {

        return $this->model->findOrFail($id);
    }

    public function destroy($id)
    {
        $student = $this->model->findOrFail($id);
        $currentImage = $student->image;
        $student->delete();
        $this->model->deleteImage($currentImage, $this->imagePath);
        return 'Xóa khoa thành  công';
    }
}
