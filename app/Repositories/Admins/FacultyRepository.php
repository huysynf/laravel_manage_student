<?php
namespace App\Repositories\Admins;

use App\Repositories\BaseRepository;
use App\Models\Faculty;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;

class FacultyRepository extends BaseRepository
{
    public function __construct(Faculty $model)
    {
        $this->model = $model;
    }
    public function search(array $data)
    {

        $faculties = $this->model->search($data['name']??null, $data['lesson']??null);
        return $faculties;
    }

    public function create(array $data):Faculty
    {
        $faculty= $this->model->create($data);
        return  $faculty;

    }

    public function update(array $data, $id)
    {
        $faculty = $this->model->findOrFail($id);
        $faculty->update($data);
        return $faculty;

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
