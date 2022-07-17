<?php

namespace App\Http\Controllers\Estate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Picture;
use App\Bukken;
use Illuminate\Support\Facades\Storage;

class PicturesController extends Controller
{
    // 画像削除のアクション
    public function destroy($id)
    {
        // アップロードした画像のパスを取得
        $image_path = Picture::findOrFail($id)->image_path;
        // S3に保存している画像へのパス
        $s3_image_path = str_replace('https://kinjotakumi-bukkenportalsite.s3.ap-northeast-1.amazonaws.com/', '', $image_path);
        // S3から画像を削除
        Storage::disk('s3')->delete($s3_image_path);
        // テーブルから画像を削除
        Picture::where('image_path', $image_path)->delete();
        
        return back();
    }
}
