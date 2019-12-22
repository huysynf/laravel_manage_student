<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\ImageTrait;
class User extends Authenticatable
{
    use Notifiable,ImageTrait;

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

    public function getPaginate($number){
        return $this->orderBy('id', 'desc')->paginate($number);
    }

    public function search($searchkey)
    {
        return $this->where('name', 'LIKE', '%' . $searchkey . '%')
            ->orwhere('email', 'LIKE', '%' . $searchkey . '%')
            ->orwhere('phone', 'LIKE', '%' . $searchkey . '%')
            ->get();
    }
    public  function changePassword($id,$password){
        return $this->where('id',$id)->update(['password'=>$password]);
    }
}
