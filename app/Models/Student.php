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
        return $this->belongsToMany(Classroom::class, 'classroom_student');
    }

    public function findOrFail($id)
    {
        return $this->with('classrooms')->findOrFail($id);
    }

    public function search($name, $address, $classroomName)
    {
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
