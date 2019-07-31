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

Route::get('/', function () {
    return view('welcome');
});

/*---------------------------checkin----------------------------------------*/
Route::middleware(['web', 'admin'])->group(function () {
	Route::resource('users', 'UsersController')->only('index','update','destroy');
	Route::get('role',['uses'=>'AdminController@role', 'as' => 'role']);
	Route::resource('admin', 'AdminController');
    Route::get('dashboard',['uses'=>'AdminController@dashboard', 'as' => 'dashboard']);
});

/*---------------------------login----------------------------------------*/
Route::get('login', 'LoginController@getLogin');
Route::post('login', ['uses' => 'LoginController@postLogin', 'as' => 'login']);
Route::get('logout', ['uses' => 'LoginController@getLogout', 'as' => 'logout']);
Route::get('/auth/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'SocialAuthController@handleProviderCallback');
