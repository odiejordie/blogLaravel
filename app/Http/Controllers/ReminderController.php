<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ReminderRequest;
use Session, Event;
use Sentinel, Reminder;
use App\Events\ReminderEvent;

class ReminderController extends Controller
{
    public function create(){
    	return view('reminders.create');
    }

    public function store(Request $req){
    	$getuser = User::where('email', $req->email)->first();

    	if($getuser){
    		$user = Sentinel::findById($getuser->id);
    		($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));
    		Event::fire(new ReminderEvent($user, $reminder));
    		Session::flash('notice', 'Cek email Eaa!! untuk info lebih lanjut');
    	}else{
    		Session::flash('error', 'Email tidak valid');
    	}

    	return view('reminders.create');
    }

    public function edit($id, $code){
    	$user = Sentinel::findById($id);
    	if(Reminder::exists($user, $code)){
    		return view('reminders.edit', array('id' => $id, 'code' => $code));
    	}else{
    		return redirect('/');
    	}
    }

    public function update(ReminderRequest $req, $id, $code){
    	$user = Sentinel::findById($id);
    	$reminder = Reminder::exists($user, $code);

    	if($reminder){
    		Session::flash('notice', 'Password berhasil di ubah.');
    		Reminder::complete($user, $code, $req->password);
    		return redirect('login');
    	}else{
    		Session::flash('error', 'Password harus sama.');
    	}
    }
}
