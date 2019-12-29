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
        'role',
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
                $query->orwhere('role', $role);
            })
            ->latest('id')
            ->paginate(10);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function hasAccess(array $permissions){
        foreach ($this->roles as $role){
            if($role->hasAcess($permissions)){
                return true;
            }
        }
        return false;
    }
    public function inRole(String $role){
        return $this->roles()->where('slug',$role)->count()==1;
    }

}
