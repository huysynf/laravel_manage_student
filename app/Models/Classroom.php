<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $tablle = 'classrooms';
    protected $fillable = [
        'name',
        'faculty_id',
        'description',
        'member',
        'subject_id',
    ];
    public $timestamps = false;

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function search(array $data)
    {
        $classroomName=$data['name']??null;
        $facultyName=$data['faculty']??null;
        $subjectName=$data['subject']??null;
        return $this->when($classroomName, function ($query) use ($classroomName) {
            $query->orwhere('name', 'LIKE', '%' . $classroomName . '%');
        })
            ->when($facultyName, function ($query) use ($facultyName) {
                $query->whereHas('faculty', function ($q) use ($facultyName) {
                    $q->where('name', $facultyName);
                });
            })
            ->when($subjectName, function ($query) use ($subjectName) {
                $query->whereHas('subject', function ($q) use ($subjectName) {
                    $q->where('name', $subjectName);
                });
            })
            ->latest('id')->paginate(5);
    }


}
