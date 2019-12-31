<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'lesson',
        'description',
    ];
    public $timestamps = false;

    public function search($name, $lesson)
    {
        return $this
            ->when($name, function ($query) use ($name) {
                $query->orwhere('name', 'LIKE', '%' . $name . '%');
            })
            ->when($lesson, function ($query) use ($lesson) {
                $query->orwhere('lesson', 'LIKE', '%' . $lesson . '%');
            })
            ->latest('id')
            ->paginate(10);

    }
}
