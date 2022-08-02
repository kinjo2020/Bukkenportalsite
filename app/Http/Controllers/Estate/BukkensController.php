<?php

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Bukken;
use App\Picture;

class BukkensController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:estate');
    }
    
    public function index(Request $request)
    {
        $data = [];
        $keyword = $request->search;
        
        // 認証済み不動産会社のみ
        if (Auth::guard('estate')->check())
        {
            // キーワード存在する場合、$keywordの部分一致で物件取得
            if ($keyword) {
                // 認証済み不動産会社を取得
                $estate = Auth::guard('estate')->user();
                // 不動産会社の物件を作成日時の降順で作成
                $bukkens = $estate->bukkens()->where('address', 'like', '%'.$keyword.'%')->orderBy('created_at', 'desc')->get();
                
            } else {
                // 認証済み不動産会社を取得
                $estate = Auth::guard('estate')->user();
                // 不動産会社自身の物件のみ取得 
                $bukkens = $estate->bukkens()->where('estate_id', $estate->id)->orderBy('created_at', 'desc')->get();
            }
            
            // 画像をすべて取得
            $pictures = Picture::all();
            
            $data = [
                'bukkens' => $bukkens,
                'pictures' => $pictures,
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
            'picture' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
        ]);

        // 認証済み不動産会社の物件として作成（リクエストされた値をもとに作成）
        $new_bukken = $request->user()->bukkens()->create([
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
        
        $picture = new Picture;
        
        $image = $request->file('picture');
        
        if (!empty($image)) {
            // バケットのkinjotakumi-bukkenportalsiteフォルダへアップロード
            $path = Storage::disk('s3')->putFile('kinjotakumi-bukkenportalsite', $image, 'public');
            
            // 作成した物件の物件画像をテーブルに保存
            $picture->create([
                'bukken_id' => $new_bukken->id,
                'image_path' => Storage::disk('s3')->url($path),
            ]);
        }

        // 物件管理ページへリダイレクトさせる
        return redirect('/estate');
    }
    
    public function show($id)
    {
        // idの物件を取得
        $bukken = Bukken::findOrFail($id);
        // idのの物件画像を取得
        $pictures = Picture::where('bukken_id', $id)->get();
        
        // 認証済みの不動産会社idと物件estate_idが同じ場合、詳細ページに遷移する
        if (Auth::guard('estate')->id() === $bukken->estate_id) {
            return view('estate.show', [
                'bukken' => $bukken,
                'pictures' => $pictures,
            ]);
        } else {
            // それ以外は物件管理ページにリダイレクトさせる
            return redirect('/estate');
        }
    }
    
    public function edit($id)
    {
        //  idの物件を取得
        $bukken = Bukken::findOrFail($id);
        // bukken_idが物件のidと同じ物件画像を取得
        $pictures = Picture::where('bukken_id', $id)->get();
          
        // 認証済みの不動産会社idと物件のestate_idが同じ場合、修正ページに遷移する
        if (Auth::guard('estate')->id() === $bukken->estate_id) {
            return view('estate.edit', [
                'bukken' => $bukken,
                'pictures' => $pictures,
            ]);
        } else {
            // それ以外は物件管理ページにリダイレクトさせる
            return redirect('/estate');
        }
    }
    
    public function update(Request $request, $id)
    {
        // idの物件取得する
        $bukken = Bukken::findOrFail($id);
        
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
            'picture' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
        ]);
        
        // 認証済み不動産会社idと物件estate_idが同じ場合、物件情報を更新
        if (Auth::guard('estate')->id() === $bukken->estate_id) {
            $bukken->update([
                $bukken->name = $request->name,
                $bukken->kinds = $request->kinds,
                $bukken->address = $request->address,
                $bukken->rent = $request->rent,
                $bukken->management_fee => $request->management_fee,
                $bukken->floor = $request->floor,
                $bukken->floor_plan = $request->floor_plan,
                $bukken->nearest_station = $request->nearest_station,
                $bukken->age = $request->age,
            ]);
            
            $picture = new Picture;
            
            $image = $request->file('picture');
            
            // 画像が添付されている場合
            if (!empty($image)) {
                // バケットのkinjotakumi-bukkenportalsiteフォルダへアップロード
                $path = Storage::disk('s3')->putFile('kinjotakumi-bukkenportalsite', $image, 'public');
                
                // 作成した物件の物件画像をテーブルに保存
                $picture->create([
                    'bukken_id' => $bukken->id,
                    'image_path' => Storage::disk('s3')->url($path),
                ]);
            }
            
            
            
            
        }
    
        // 物件q管理ページにリダイレクトさせる
        return redirect('/estate');
    }
    
    public function destroy($id)
    {
        // idの物件を取得
        $bukken = Bukken::findOrFail($id);
        
        // 認証済み不動産会社idと物件estate_idが同じ場合、物件を削除
        if (Auth::guard('estate')->id() === $bukken->estate_id) {
            $bukken->delete();
        }
        
        // 物件管理ページにリダイレクトさせる
        return redirect('/estate');
    }
}
