<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected $user_route = 'user.login';
    protected $estate_route = 'estate.login';
    
    protected function redirectTo($request)
    {
        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (! $request->expectsJson()) {
            if (Route::is('user.*')) {
                return route($this->user_route);
            }
            elseif (Route::is('estate.*')) {
                return route($this->estate_route);
            }
        }
    }
}
