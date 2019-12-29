<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use ImageTrait;

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
        return $this->belongsToMany(Classroom::class, 'classroom_student')->withPivot('classroom_id');
    }

    public function findOrFail($id)
    {
        return $this->with('classrooms')->findOrFail($id);
    }
    public function getClassroomIdByStudentId($id){
        return $this->with('classrooms')->findOrFail($id)->pluck('classroom_id');
    }
    public function search($data)
    {
        $name=$data['name']??null;
        $address=$data['address']??null;
        $classroomName=$data['classrooms']??null;
        return $this
            ->when($classroomName, function ($query) use ($classroomName) {
                $query->whereHas('classrooms', function ($q) use ($classroomName) {
                    $q->where('name',$classroomName );
                });
            })
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($address, function ($query) use ($address) {
                $query->orwhere('address', 'LIKE', '%' . $address . '%');
            })
            ->latest('id')
            ->paginate(10);
    }
}
