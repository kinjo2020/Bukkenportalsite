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
            Auth::guard('user')->user()->history($id);
        } 
        
        return view('user.show', [
            'bukken' => $bukken,
        ]);
    }
    
    public function favorites()
    {
        // 認証済みユーザーを取得
        $user = Auth::guard('user')->user();
        
        // お気に入り登録した物件一覧を登録日時順で取得
        $favorites = $user->favorites()->orderBy('pivot_created_at', 'desc')->get();
        
        return view ('user.favorites', [
            'user' => $user,
            'bukkens' => $favorites,
        ]);
    }
    
    public function histories()
    {
        // 認証済みユーザーを取得
        $user = Auth::guard('user')->user();
        
        // 閲覧済み物件を更新日時順で取得
        $histories = $user->histories()->orderBy('pivot_updated_at', 'desc')->get();
        
        return view('user.histories', [
            'bukkens' => $histories,
        ]);
    }
}
