<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $tablle = 'subjects';
    protected $fillable = [
        'name',
        'lesson',
        'description',
    ];
    public $timestamps = false;

    public function search($searchKey)
    {
        return $this->where('name', 'LIKE', '%' . $searchKey . '%')
            ->orwhere('description', 'LIKE', '%' . $searchKey . '%')
            ->orwhere('lesson', 'LIKE', '%' . $searchKey . '%')
            ->get(['id', 'name','lesson','description']);
    }

    public function getpaginate($number){
        return $this->orderBy('id', 'desc')->paginate($number);
    }

}
