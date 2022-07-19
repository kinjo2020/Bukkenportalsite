<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Bukken;
use App\Picture;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }
    
    public function index(Request $request)
    {
        $keyword = $request->search;
        
        // 認証済みユーザの場合
        if (Auth::guard('user')->check()) {
            // キーワード存在する場合、$keywordの部分一致で物件取得
            if ($keyword) {
                $bukkens = DB::table('bukkens')
                    ->where('address', 'like', '%'.$keyword.'%')
                    ->get();
            // それ以外、物件をすべて取得 
            } else {
                $bukkens = Bukken::all();
            }
            
            // 物件画像をすべて取得
            $pictures = Picture::all();
        };
        
        return view('user.index', [
            'bukkens' => $bukkens,
            'pictures' => $pictures,
        ]);
    }
    
    public function show($id)
    {
        // 認証済みユーザの場合
        if (Auth::guard('user')->check()) {
            // idの物件を取得
            $bukken = Bukken::findOrFail($id);
            // idの物件画像を取得
            $pictures = Picture::where('bukken_id', $id)->get();
            // 閲覧済み一覧も物件に追加
            Auth::guard('user')->user()->history($id);
        } 
        
        return view('user.show', [
            'bukken' => $bukken,
            'pictures' => $pictures,
        ]);
    }
    
    public function favorites()
    {
        // 認証済みユーザーを取得
        $user = Auth::guard('user')->user();
        
        // お気に入り登録した物件一覧を登録日時順で取得
        $favorites = $user->favorites()->orderBy('pivot_created_at', 'desc')->get();
        // 物件画像を取得
        $pictures = Picture::all();
        
        return view ('user.favorites', [
            'user' => $user,
            'bukkens' => $favorites,
            'pictures' => $pictures,
        ]);
    }
    
    public function histories()
    {
        // 認証済みユーザーを取得
        $user = Auth::guard('user')->user();
        
        // 閲覧済み物件を更新日時順で取得
        $histories = $user->histories()->orderBy('pivot_updated_at', 'desc')->get();
        // 物件画像を取得
        $pictures = Picture::all();
        
        return view('user.histories', [
            'bukkens' => $histories,
            'pictures' => $pictures,
        ]);
    }
}
