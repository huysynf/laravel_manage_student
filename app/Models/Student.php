<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'name',
        'address',
        'image',
        'birthday',
        'phone',
        'gender',
    ];
    public $timestamps = false;

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_student');
    }

    public function search($name, $address, $classroomName)
    {
        return $this
            ->when($classroomName,function ($query) use ($classroomName) {
                $query->whereHas('classrooms',function($q) use ($classroomName){
                    $q->orwhere('name','LIKE','%'.$classroomName.'%');
                });
            })
            ->when($name, function ($query) use ($name) {
                $query->orwhere('name', 'LIKE', '%' . $name . '%');
            })
            ->when($address, function ($query) use ($address) {
                $query->orwhere('address', 'LIKE', '%' . $address . '%');
            })
            ->paginate(5);
    }




}
