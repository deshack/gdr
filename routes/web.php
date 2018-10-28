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

Route::get( '/', function () {
    return view( 'welcome' );
} );

Auth::routes();

Route::get( '/home', 'HomeController@index' )->name( 'home' );

Route::group( [
    'middleware' => 'auth'
], function () {
    Route::get( '/chat', 'ChatController@index' )->name( 'chat.channels' );
    Route::get( '/chat/{channel}', 'ChatController@show' )->name( 'chat.channels.show' );

    Route::post( '/channels/{channel}/messages', 'ChatController@storeMessage' );
    Route::get( '/channels/{channel}/messages', 'ChatController@getMessages' );
} );
