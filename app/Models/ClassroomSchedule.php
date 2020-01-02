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

}
