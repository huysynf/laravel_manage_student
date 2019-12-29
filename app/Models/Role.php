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
        return $this->belongsToMany(Permission::class,'role_permission');
    }
    public function users(){
        $this->belongsToMany(User::class);
    }
    public function findOrFail($id){
        return $this->with('permissions')->findOrFail($id);
    }
    public function search($name,$permission){
            return $this
                ->when($permission, function ($query) use ($permission) {
                    $query->whereHas('permissions', function ($q) use ($permission) {
                        $q->where('name',$permission );
                    });
                })
                ->when($name, function ($query) use ($name) {
                    $query->where('name', 'LIKE', '%' . $name . '%');
                })
                ->latest('id')
                ->paginate(10);
    }
    public function hasPermission($slug,$id)
    {
        return $this
        ->when($slug, function ($query) use ($slug) {
            $query->whereHas('permissions', function ($q) use ($slug) {
                $q->where('slug',$slug );
            });
        })->where('id',$id)->count()>0 ;
    }
}
