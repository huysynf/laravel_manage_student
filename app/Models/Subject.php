<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $tablle='subjects';
    protected $fillable=[
        'name',
        'lesson',
        'description',
    ];
    public $timestamps = false;
}
