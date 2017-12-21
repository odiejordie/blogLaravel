<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Http\Requests\UserRequest;

class SignupController extends Controller
{
    public function signup(){
        return redirect()->route('signup');
    }

    public function signup_store(UserRequest $req){
    	$data = array(
    		'email' => $req->email,
    		'password' => $req->password,
    		'first_name' => $req->first_name,
    		'last_name' => $req->last_name,
    	);
    	/*dd($data);*/
        Sentinel::registerAndActivate($data);
        return redirect()->back();
    }
}
