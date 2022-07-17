<?php

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

        // ユーザーページ
        Route::get('/{id}', 'UserController@show')->where('id', '[0-9]+')->name('show');
        Route::resource('/', 'UserController', ['only' => 'index']);
        Route::get('/favorites', 'UserController@favorites')->name('bukken.favorites');
        Route::get('/histories', 'UserController@histories')->name('bukken.histories');
        
        // 物件お気に入り登録、お気に入り削除
        Route::post('/{id}/favorite', 'FavoritesController@store')->name('bukken.favorite');
        Route::delete('/{id}/unfavorite', 'FavoritesController@destroy')->name('bukken.unfavorite');
        
        // 物件の閲覧済みを削除
        Route::delete('/{id}/unhistory', 'HistoriesController@destroy')->name('bukken.unhistory');

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

        // 不動産会社ページ
        Route::get('/{id}', 'BukkensController@show')->where('id', '[0-9]+')->name('show');
        Route::get('/{id}/edit', 'BukkensController@edit')->where('id', '[0-9]+')->name('edit');
        Route::put('/{id}', 'BukkensController@update')->where('id', '[0-9]+')->name('update');
        Route::delete('/{id}', 'BukkensController@destroy')->where('id', '[0-9]+')->name('destroy');
        Route::resource('/', 'BukkensController', ['only' => ['index', 'create', 'store']]);
        
        // 物件画像の削除
        Route::delete('/{id}/picture_delete', 'PicturesController@destroy')->where('id', '[0-9]')->name('picture.destroy');

    });

});
