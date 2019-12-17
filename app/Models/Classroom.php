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


}
