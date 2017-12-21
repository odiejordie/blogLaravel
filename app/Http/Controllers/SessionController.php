<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Http\Requests\SessionRequest;

class SessionController extends Controller
{
    public function login(){
    	if($user = Sentinel::check()){
    		return redirect()->route('user.index');
    	}else{
    		return view('login');
    	}
    }

    public function login_store(SessionRequest $req){
    	if($user = Sentinel::authenticate($req->all())){
    		return redirect()->route('user.index');
    	}else{
    		return view('login');
    	}
    }

    public function logout(){
    	Sentinel::logout();
    	return redirect('login');
    }
}
