<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class Faculty extends Model
{
    use Searchable;
    protected $table = 'faculties';
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

    public function searchableAs()
    {
        return 'faculties_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return $array;
    }

}
