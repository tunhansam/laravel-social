<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Session;
use App\Repositories\UserRepository;

class LoginController extends Controller
{
    protected $_user;

    public function __construct(UserRepository $user) 
    {
        $this->_user = $user;
    }

    public function getLogin() 
    {
    	if (Auth::guard('admin')->check()) {
    		return redirect()->route('dashboard');
    	}
    	return view('login.login');
    }

    public function postLogin(LoginRequest $request) 
    {
    	$data = [
    		'email' 	=> $request->input('email'),
    		'password' 	=> $request->input('password'), 
    	];
    	if (Auth::guard('admin')->attempt($data, false)) {
            return redirect()->route('admin.index');
    	} 
		$errors['login'] = trans('notification.failLogin');
		return redirect()->back()->withErrors($errors)->withInput();
    }

    public function getLogout() {

        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

   
}