<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Broadcasting\ChatChannel;
use App\Models\Chat\Channel;

//Broadcast::channel( 'App.User.{id}', function ( $user, $id ) {
//    return (int) $user->id === (int) $id;
//} );

Broadcast::channel( 'chat.{channel}', function ( Channel $channel ) {
    return true;
} );
