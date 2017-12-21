<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
    	return $this->belongsTo('App\Post', 'post_id');
    }

    protected $fillable = [
        'post_id', 'comment', 'full_name'
    ];
}
