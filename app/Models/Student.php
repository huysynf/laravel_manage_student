<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table='students';
    protected $fillable=[
        'name',
        'address',
        'image',
        'birthday',
        'phone',
        'gender',
    ];
    public function classrooms(){
        return $this->belongsToMany(Classroom::class,'classroom_student');
    }
    public $timestamps = false;

}
