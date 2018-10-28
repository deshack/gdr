<?php

namespace App\Broadcasting;

use App\Models\Chat\Channel;
use App\Models\User;

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
     * @param User    $user
     * @param Channel $channel
     *
     * @return array|bool
     */
    public function join( User $user, Channel $channel ) {
        return [
            'id'   => $user->id,
            'name' => $user->name,
        ];
    }
}
