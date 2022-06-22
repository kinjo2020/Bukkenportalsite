<?php

namespace App\Http\Controllers\Estate\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = RouteServiceProvider::ESTATE_HOME;

    public function __construct()
    {
        $this->middleware('guest:estate')->except('logout');
    }
    
    // Guardの認証方法
    protected function guard()
    {
        return Auth::guard('estate');
    }
    
    // ログイン画面
    public function showLoginForm()
    {
        return view('estate.auth.login');
    }
    
    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('estate')->logout();
        
        return $this->loggedOut($request);
    }
    
    // ログアウトした時のリダイレクト先
    public function loggedOut(Request $request)
    {
        return redirect(route('estate.login'));
    }
}
