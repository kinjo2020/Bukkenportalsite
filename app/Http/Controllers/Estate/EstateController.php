<?php

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

class EstateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:estate');
    }
    
    public function index()
    {
        $data = [];
        
        // 認証済み不動産会社のみ
        if (Auth::guard('estate')->check())
        {
            // 認証済み不動産会社を取得
            $estate = Auth::guard('estate')->user();
            
            // 不動産会社の物件を作成日時の降順で作成
            $bukkens = $estate->bukkens()->orderBy('created_at', 'desc')->get();
            
            $data = [
                'estate' => $estate,
                'bukkens' => $bukkens,
            ];
        }
        
        return view('estate.home', $data);
    }
}
