<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Bukken;
use App\Estate;
use App\Mail\ContactSendmail;

class ContactController extends Controller
{
    // お問い合わせ入力画面へおアクション
    public function input($id)
    {
        $bukken = Bukken::findOrFail($id);
        
        return view('user.contact.input', [
            'bukken' => $bukken,
        ]);
    }
    
    // お問い合わせ確認画面へのアクション
    public function confirm(Request $request, $id)
    {
        $bukken = Bukken::findOrFail($id);
        
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body' => 'required',
        ]);
        
        // フォームから受けとったすべての値を取得
        $inputs = $request->all();
        
        return view('user.contact.confirm', [
            'bukken' => $bukken,
            'inputs' => $inputs,
        ]);
    }
    
    // お問い合わせ送信のアクション
    public function send(Request $request, $bukken_id)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'body' => 'required',
        ]);
        
        // フォームから受け取った値を取得
        $inputs = $request;
        
        // 入力されたメールアドレスにサンクスメールを送信
        $inputs["subject"] = '自動送信メール';
        $inputs["template"] = 'user.contact.thanks_mail';
        Mail::to($inputs['email'])->send(new ContactSendmail($inputs));
        
        // 物件の不動産のメールアドレスを取得
        $bukken_estate_id = Bukken::findOrFail($bukken_id)->estate_id;
        $estate_email = Estate::findOrFail($bukken_estate_id)->email;
        
        // 問い合わせする物件の不動産会社に入力した内容のメールを送信
        $inputs["subject"] = 'お問い合わせ物件';
        $inputs["template"] = 'user.contact.toiawase_mail';
        Mail::to($estate_email)->send(new ContactSendmail($inputs));
        
        // 再送信を防ぐためにトークンを再発行
        $request->session()->regenerateToken();
        
        return view('user.contact.finish');
        
    }
}