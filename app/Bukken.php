<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bukken extends Model
{
    protected $fillable = [
        'kinds', 'name', 'address', 'rent', 'management_fee', 'floor', 'floor_plan', 'nearest_station', 'age',
    ];
    
    
    // 物件を管理している不動産
    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
    
    // 物件の画像
    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    
    // 物件をお気に入りしたユーザー
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'bukken_id', 'user_id');
    }
}
