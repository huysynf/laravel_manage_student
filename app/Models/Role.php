<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $fillable=[
        'name',
        'slug',
    ];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
    public function users(){
        $this->hasMany(User::class);
    }
    public function  hassAccess(array $permissions):bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
    }
    private function hasPermission(string $permission) : bool
    {
        return $this->permissions()->where('slug',$permission);
    }
}
