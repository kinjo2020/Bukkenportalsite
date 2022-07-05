<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // ユーザがお気に入りしている物件
    public function favorites()
    {
        return $this->belongsToMany(Bukken::class, 'favorites', 'user_id', 'bukken_id')->withTimestamps();
    }
    
    // お気に入り登録
    public function favorite($bukkenId)
    {
        // すでにお気に入りしているか確認
        $exist = $this->is_favorite($bukkenId);
        
        if ($exist) {
            // お気に入りしている場合はなにもしない
            return false;
        } else {
            //上記以外はお気に入り登録
            return $this->favorites()->attach($bukkenId);
        }
    }
    
    // お気に入り削除
    public function unfavorite($bukkenId)
    {
        // すでにお気に入りしているか確認
        $exist = $this->is_favorite($bukkenId);
        
        if ($exist) {
            // お気に入りされている場合は削除
            return $this->favorites()->detach($bukkenId);
        } else {
            // 上記以外はなにもしない
            return false;
        }
    }
    
    // お気に入り中の物件が存在するか
    public function is_favorite($bukkenId)
    {
        return $this->favorites()->where('bukken_id', $bukkenId)->exists();
    }
    
    // ユーザーが閲覧済み物件
    public function histories()
    {
        return $this->belongsToMany(Bukken::class, 'histories', 'user_id', 'bukken_id')->withTimestamps();
    }
    
    // 物件を閲覧済みに登録、更新
    public function history($bukkenId)
    {
        // すでに閲覧済みか確認
        $exist = $this->is_history($bukkenId);
        
        if ($exist) {
            // 中間テーブルのbukkenn_idを取得
            $pivot_id = $this->histories()->where('bukken_id', $bukkenId)->get();
            // 閲覧済みの場合は中間テーブルを更新
            return $this->histories()->updateExistingPivot($pivot_id, ['updated_at' => $bukkenId]);
        } else {
            // それ以外は閲覧済みにする
            return $this->histories()->attach($bukkenId);
        }
    }
    
    // 閲覧済みから削除
    public function unhistory($bukkenId)
    {
        // すでに閲覧済みか確認
        $exist = $this->is_history($bukkenId);
        
        if ($exist) {
            // 閲覧済みの物件は削除
            return $this->histories()->detach($bukkenId);
        } else {
            // それ以外はなにもしない
            return false;
        }
    }
    
    // 閲覧済みの物件が存在しているか
    public function is_history($bukkenId)
    {
        return $this->histories()->where('bukken_id', $bukkenId)->exists();
    }
}
