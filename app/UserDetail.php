<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    protected $fillable = [
        'user_id', 'alamat', 'jenkel', 'nohp', 'ttl', 'hobi', 'foto',
    ];
}
