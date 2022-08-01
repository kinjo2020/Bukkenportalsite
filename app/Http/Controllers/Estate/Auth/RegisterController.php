<?php

namespace App\Http\Controllers\Estate\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Estate;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ESTATE_HOME;

    public function __construct()
    {
        $this->middleware('guest:estate');
    }
    
    // Guardの認証方法指定
    public function guard()
    {
        return Auth::guard('estate');
    }
    
    // 新規登録処理
    public function showRegistrationForm()
    {
        return view(('estate.auth.register'));
    }

    // バリデーション
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // 登録処理
    protected function create(array $data)
    {
        return Estate::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
