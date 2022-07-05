<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    // 閲覧済みから削除
    public function destroy($id)
    {
        $user = Auth::guard('user')->user()->unhistory($id);
        
        return back();
    }
}
