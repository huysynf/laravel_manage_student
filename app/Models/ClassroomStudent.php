<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassroomStudent extends Pivot
{
    protected $table='classroom_student';

    public function getClassroomIdByStudentId($id){
        return $this->where('student_id',$id)->pluck('classroom_id');
    }
}
