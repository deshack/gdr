<?php

namespace App\Http\Controllers;

use App\Events\MessagePushed;
use App\Http\Resources\Chat\Message as MessageResource;
use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Illuminate\Http\Request;

class ChatController extends Controller {
    public function index() {
        return view( 'chat.channels', [
            'channels' => Channel::all(),
        ] );
    }

    public function show( Channel $channel ) {
        return view( 'chat.channel', [
            'channel' => $channel,
        ] );
    }

    public function getMessages( Channel $channel ) {
        $messages = $channel->messages()
                            ->whereDate( 'created_at', '>=', now()->subHour() )
                            ->orderBy( 'created_at' )
                            ->get();

        return MessageResource::collection( $messages );
    }

    public function storeMessage( Request $request, Channel $channel ) {
        $message = Message::forceCreate( [
            'channel_id' => $channel->id,
            'user_id'    => request( 'user_id' ),
            'message'    => request( 'message' ),
        ] );

        broadcast( new MessagePushed( $channel, $message ) );

        return new MessageResource( $message );
    }
}
