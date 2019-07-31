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

/*---------------------------login----------------------------------------*/
Route::get('loginFb', 'LoginController@getLoginFb');
Route::post('loginFb', ['uses' => 'LoginController@postLoginFb', 'as' => 'loginFb']);
Route::get('logoutFb', ['uses' => 'LoginController@getLogoutFb', 'as' => 'logoutFb']);
