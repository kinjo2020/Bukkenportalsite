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
}
