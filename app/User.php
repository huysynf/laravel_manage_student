<?php

namespace App;

use App\Models\Role;
use App\Traits\ImageTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, ImageTrait;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function changePassword($id, $password)
    {
        return $this->where('id', $id)->update(['password' => $password]);
    }

    public function search($name, $role)
    {
        return $this
            ->when($name, function ($query) use ($name) {
                $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($role, function ($query) use ($role) {
                $query->whereHas('role', function ($q) use ($role) {
                    $q->where('name', $role);
                });
            })
            ->latest('id')
            ->paginate(10);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function findOrFail($id)
    {
        return $this->with('role')->findOrFail($id);
    }

    public function hasPermissionByRoleId($name, $role_id)
    {
        return $this->role->hasPermission($name, $role_id);
    }
}
