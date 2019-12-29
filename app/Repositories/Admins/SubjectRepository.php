<?php
namespace App\Repositories\Admins;

use App\Repositories\BaseRepository;
use App\Models\Subject;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;

class SubjectRepository extends BaseRepository
{
    public function __construct(Subject $model)
    {
        $this->model = $model;
    }
    public function search(array $data)
    {
        return $this->model->search($data['name']??null, $data['lesson']??null);;
    }

    public function create(array $data):Subject
    {
        return   $this->model->create($data);

    }

    public function update(array $data, $id)
    {
        $subject = $this->model->findOrFail($id);
        $subject->update($data);
        return $subject;

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
