<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    // お気に入り登録アクション
    public function store($id)
    {
        // 認証済みユーザが、物件をお気に入り登録する
        Auth::guard('user')->user()->favorite($id);
        
        return back();
    }
    
    // お気に入り削除アクション
    public function destroy($id)
    {
        // 認証済みユーザが、物件をお気に入り削除する
        Auth::guard('user')->user()->unfavorite($id);
        
        return back();
    }
}
