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
    
    public function favorites()
    {
        // 認証済みユーザーを取得
        $user = Auth::guard('user')->user();
        
        // お気に入り登録した物件一覧を作成日時順で取得
        $favorites = $user->favorites()->orderBy('created_at', 'desc')->get();
        
        return view ('user.favorites', [
            'user' => $user,
            'bukkens' => $favorites,
        ]);
    }
}
