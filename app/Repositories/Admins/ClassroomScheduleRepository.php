<?php


namespace App\Repositories\Admins;

use App\Models\Classroom;
use App\Models\ClassroomSchedule;
use App\Repositories\BaseRepository;

class ClassroomScheduleRepository extends BaseRepository
{
    protected $classroom;

    public function __construct(ClassroomSchedule $classroomSchedule)
    {
        $this->model = $classroomSchedule;
        $this->classroom = new Classroom();
    }

    public function create($id)
    {
        $data['row'] = 4;
        $data['col'] = 6;
        $data['id'] = $id;
        $data['classroomSchedule'] = $this->model->getDateTimeOfClassroomSchedule($data);
        $data['classroom'] = $this->classroom->findOrFail($id);

        return $data;
    }

    public function store(array $data)
    {
        $flag = $this->model->checkDayTimeClassroom($data);
        if (!$flag) {
            $this->model->create($data);

            return 'Tạo lịch thành công';
        } else {

            return 'Lich  này đã có !';
        }
    }

    public function destroy($id)
    {
        $this->model->destroy($id);

        return 'Xóa thành công';
    }

}
