<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function posts(){
        return $this->hasMany('App\Post', 'user_id');
    }

    public function userdetail(){
        return $this->hasOne('App\UserDetail', 'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'first_name', 'email', 'password', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
