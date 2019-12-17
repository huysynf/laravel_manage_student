<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom_student extends Model
{
    protected $table='classroom_student';

    public function getclassroomid($id){
        return $this->where('student_id',$id)->pluck('classroom_id');
    }
}
