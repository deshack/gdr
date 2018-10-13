<?php

namespace App\Broadcasting;

use App\Models\Chat\Channel;
use App\User;

class ChatChannel {
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\User $user
     * @param Channel    $channel
     *
     * @return array|bool
     */
    public function join( User $user, Channel $channel ) {
        return [
            'user_id'    => $user->id,
            'channel_id' => $channel->id,
        ];
    }
}
