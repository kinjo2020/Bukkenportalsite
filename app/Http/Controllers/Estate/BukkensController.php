<?php

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Bukken;

class BukkensController extends Controller
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
        
        return view('estate.index', $data);
    }
    
    public function create()
    {
        $bukken = new Bukken;
        
        return view('estate.create', [
            'bukken' => $bukken
        ]);
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'kinds' => 'required|max:255',
            'address' => 'required|max:255',
            'rent' => 'required|max:255',
            'management_fee' => 'required|max:255',
            'floor' => 'required|max:255',
            'floor_plan' => 'required|max:255',
            'nearest_station' => 'required|max:255',
            'age' => 'required|max:255',
        ]);

        // 認証済み不動産会社の物件として作成（リクエストされた値をもとに作成）
        $request->user()->bukkens()->create([
            'name' => $request->name,
            'kinds' => $request->kinds,
            'address' => $request->address,
            'rent' => $request->rent,
            'management_fee' => $request->management_fee,
            'floor' => $request->floor,
            'floor_plan' => $request->floor_plan,
            'nearest_station' => $request->nearest_station,
            'age' => $request->age,
        ]);

        // 物件管理ページへリダイレクトさせる
        return redirect('/estate');
    }
    
    public function show($id)
    {
        // idの物件を取得
        $bukken = Bukken::findOrFail($id);
        // dd($bukken);
        
        // 認証済みの不動産会社と物件idが同じ場合、詳細ページに遷移する
        if (Auth::guard('estate')->id() === $bukken->estate_id)
        {
            return view('estate.show', [
                'bukken' => $bukken,
            ]);
        } else
        {
            // それ以外は物件管理ページにリダイレクトさせる
            return redirect('/estate');
        }
    }
    
    public function edit()
    {
        // 
    }
    
    public function apdate()
    {
        // 
    }
    
    public function destroy()
    {
        // 
    }
}
