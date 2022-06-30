<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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
            $this->favorites()->attach($bukkenId);
            return true;
        }
    }
    
    // お気に入り削除
    public function unfavorite($bukkenId)
    {
        // すでにお気に入りしているか確認
        $exist = $this->is_favorite($bukkenId);
        
        if ($exist) {
            // お気に入りされている場合は削除
            $this->favorites()->detach($bukkenId);
            return true;
        } else {
            // 上記以外はなにもしない
            return false;
        }
    }
    
    // お気に入り中の物件が存在するか
    public function is_favorite($bukken)
    {
        return $this->favorites()->where('bukken_id', $bukken)->exists();
    }
}
