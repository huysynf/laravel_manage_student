<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassroomSchedule extends Model
{
    protected $table = 'classroomschedules';

    protected $fillable = [
        'classroom_id',
        'day',
        'time',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function checkDayTimeClassroom(array $data)
    {
        $classroomId = $data['classroom_id'];
        $day = $data['day'];
        $time = $data['time'];

        return $this->where(['classroom_id' => $classroomId, 'day' => $day, 'time' => $time])->count() > 0;
    }



    public function createArrayValueZero($row, $col): array
    {
        $arr = [];
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $col; $j++) {
                $arr[$i][$j] = 0;
            }
        }

        return $arr;
    }

    public function getDateTimeOfClassroomSchedule($data): array
    {
        $array = $this->createArrayValueZero($data['row'], $data['col']);
        $classroomSchedules = $this->where('classroom_id', $data['id'])->get();

        foreach ($classroomSchedules as $classroomSchedule) {
            $array[$classroomSchedule->time - 1][$classroomSchedule->day - 2] = $classroomSchedule->id;
        }

        return $array;
    }
}
