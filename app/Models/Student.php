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


    public function search($searchKey)
    {
        return $this->where('name', 'LIKE', '%' . $searchKey . '%')
            ->orwhere('address', 'LIKE', '%' . $searchKey . '%')
            ->orwhere('phone', 'LIKE', '%' . $searchKey . '%')
            ->with('classrooms')
            ->get();
    }

    public function getpaginate($number)
    {
        return $this->with('classrooms')->orderBy('id', 'desc')->paginate($number);
    }
    public function getstudent($id)
    {
        return $this->with('classrooms')->find($id);
    }


}
