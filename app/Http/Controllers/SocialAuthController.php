<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite, Auth, Redirect, Session, URL;
use App\Admin;

class SocialAuthController extends Controller
{
    /**
     * Chuyển hướng người dùng sang OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if(!Session::has('pre_url')){
            Session::put('pre_url', URL::previous());
        }else{
            if(URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $admin = Socialite::driver($provider)->admin();

        $authAdmin = $this->findOrCreateAdmin($admin, $provider);
        Auth::login($authAdmin, true);
        return Redirect::to(Session::get('pre_url'));
    }

    /**
     * @param  $admin Socialite admin object
     * @param $provider Social auth provider
     * @return  Admin
     */
    public function findOrCreateAdmin($admin, $provider)
    {
        $authAdmin = Admin::where('provider_id', $admin->id)->first();
        if ($authAdmin) {
            return $authAdmin;
        }
        return Admin::create([
            'name'     => $admin->name,
            'email'    => $admin->email,
            'provider' => $provider,
            'provider_id' => $admin->id
        ]);
    }
}
