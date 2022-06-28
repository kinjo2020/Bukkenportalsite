<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Bukken;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    
    public function index()
    {
        // 認証済みユーザの場合、物件をすべて取得
        if (Auth::guard('user')->check()) {
                $bukkens = Bukken::all();
        };
        
        return view('user.index', [
            'bukkens' => $bukkens,
        ]);
    }
    
    public function show($id)
    {
        // 認証済みユーザの場合、idの物件を取得
        if (Auth::guard('user')->check()) {
            $bukken = Bukken::findOrFail($id);
        } 
        
        return view('user.show', [
            'bukken' => $bukken,
        ]);
    }
}
