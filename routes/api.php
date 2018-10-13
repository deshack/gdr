<?php

use App\Events\MessagePushed;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post( '/channels/{channel}/messages', function ( Channel $channel ) {
    $message = Message::forceCreate( [
        'channel_id' => $channel->id,
//        'author'     => request( 'username' ),
        'message'    => request( 'message' ),
    ] );

    broadcast( new MessagePushed( $channel, $message ) );

    return $message;
} );
