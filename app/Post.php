<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function comments(){
    	return $this->hasMany('App\Comment', 'post_id');
    }

    protected $fillable = [
        'user_id', 'posting',
    ];
}
