<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('/', 'UserController', ['only' => 'index']);

    });
});

// 不動産会社
Route::namespace('Estate')->prefix('estate')->name('estate.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:estate')->group(function () {

        // TOPページ
        Route::get('/{id}', 'BukkensController@show')->where('id', '[0-9]+')->name('show');
        Route::get('/{id}/edit', 'BukkensController@edit')->where('id', '[0-9]+')->name('edit');
        Route::put('/{id}', 'BukkensController@update')->where('id', '[0-9]+')->name('update');
        Route::delete('/{id}', 'BukkensController@destroy')->where('id', '[0-9]+')->name('destroy');
        Route::resource('/', 'BukkensController', ['only' => ['index', 'create', 'store']]);

    });

});
