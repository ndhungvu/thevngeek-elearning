<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Admin\LoginRequest;
class AuthController extends AdminController
{
    /**
     * Login system
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin(){
        return view('admins.auth.login');
    }
    
    public function postLogin(LoginRequest $request)
    {
        $checkLogin = false;
        $login = array(
            'email' => $request->email,
            'password' => $request->password
        );
        $checkLogin = Auth::attempt($login, $request->remember);

        if($checkLogin){
            return redirect()->route('admin.dashboard')->with('flashSuccess', trans('auth.login_success'));
        }
        
        return redirect()->back()->with('flashError', trans('auth.email_password_invalid'));
    }
    
    /**
     * Logout system
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login');    
    }
}