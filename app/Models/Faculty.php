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

    public function search($searchKey){
        return $this->where('name', 'LIKE', '%' . $searchKey . '%')->orwhere('description', 'LIKE',
            '%' . $searchKey . '%')->get(['id', 'name', 'description']);
    }
}
