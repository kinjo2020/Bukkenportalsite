<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
    
    // Guardの認証方法
    protected function guard()
    {
        return Auth::guard('user');
    }
    
    // ログイン画面
    public function showLoginForm()
    {
        return view('user.auth.login');
    }
    
    // ログアウト処理
    public function logout(Request $requset)
    {
        Auth::guard('user')->logout();
        
        return $this->loggedOut($requset);
    }
    
    // ログアウトした時のリダイレクト先
    public function loggedOut(Request $requset)
    {
        return redirect(route('user.login'));
    }
}
