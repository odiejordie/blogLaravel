<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SessionController@login');
/*USER*/
Route::resource('user', 'UserController');
Route::post('user_comment','UserController@comment')->name('user.comment');
Route::get('user_comment/{id}', 'UserController@get_comment')->name('user.getcomment');
/*UPDATE BIODATA*/
Route::post('store_bio', 'UserController@bio_store')->name('bio.store');
Route::put('user_bio/{id}', 'UserController@bio_update')->name('bio.update');

/*DAFTAR*/
Route::get('signup', 'SignupController@signup')->name('signup');
Route::post('signup', 'SignupController@signup_store')->name('signup.store');

/*LOGIN*/
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@login_store')->name('login.store');

/*LOGOUT*/
Route::get('logout', 'SessionController@logout')->name('logout');

/*LUPA PASS*/
/*REMINDER INI UNTUK NGECEK DI DB EMAIL SAMA PASS NYA*/
Route::get('forgot-password', 'ReminderController@create')->name('reminders.create');
Route::post('forgot-password', 'ReminderController@store')->name('reminders.store');
/*INI UNTUK RESET PASS NYA SAMA NAMPILIN FORM NYA*/
Route::get('reset-password/{id}/{token}', 'ReminderController@edit')->name('reminders.edit');
Route::post('reset-password/{id}/{token}', 'ReminderController@update')->name('reminders.update');