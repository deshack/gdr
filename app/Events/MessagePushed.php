<?php

namespace App\Events;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel as BroadcastChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessagePushed implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Channel
     */
    private $channel;

    /**
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param Channel $channel
     * @param Message $message
     */
    public function __construct( Channel $channel, Message $message ) {
        $this->channel = $channel;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new BroadcastChannel( 'chat.' . $this->channel->id );
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith() {
        return [
            'message' => $this->message->message
        ];
    }
}
