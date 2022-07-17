<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'bukken_id', 'image_path',
    ];
    
    // 物件の物件画像
    public function bukken()
    {
        return $this->belongsTo(Bukken::class);
    }
}
