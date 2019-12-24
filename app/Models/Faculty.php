<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculties';
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

    public function search($name, $description)
    {
        return $this
            ->when($name, function ($query) use ($name) {
                $query->orwhere('name', 'LIKE', '%' . $name . '%');
            })
            ->when($description, function ($query) use ($description) {
                $query->orwhere('description', 'LIKE', '%' . $description . '%');
            })
            ->latest('id')
            ->paginate(10);
    }


}
