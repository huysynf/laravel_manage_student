<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Permission extends Model
{
    protected $table='permissions';
    protected $fillable=[
        'name',
        'slug'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function search($name)
    {
        return $this
            ->when($name, function ($query) use ($name) {
                $query->orwhere('name', 'LIKE', '%' . $name . '%');
            })
            ->latest('id')
            ->paginate(10);
    }

}
