<?php

namespace App;

use App\Models\Role;
use App\Traits\ImageTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, ImageTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function changePassword($id, $password)
    {
        return $this->where('id', $id)->update(['password' => $password]);
    }


    public function search($name, $role)
    {
        return $this->when($name, function ($query) use ($name) {
            $query->orwhere('name', 'LIKE', '%' . $name . '%');
        })
            ->when($role, function ($query) use ($role) {
                $query->whereHas('role', function ($q) use ($role) {
                    $q->where('name',$role );
                });
            })
            ->latest('id')
            ->paginate(10);
    }
    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
    public  function findOrFail($id){
        return $this->with('role')->findOrFail($id);
    }
    public function hasAccessPermissionByRoleId($name,$id){
      return $this->role->hasPermission($name,$id);
    }

}
