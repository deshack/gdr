<?php

namespace App\Events;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Queue\SerializesModels;
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
        return new PresenceChannel( 'chat.' . $this->channel->id );
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith() {
        return [
            'id'      => $this->message->id,
            'user'    => [
                'id'   => $this->message->user_id,
                'name' => $this->message->user->name,
            ],
            'message' => $this->message->message,
            'date'    => optional( $this->message->created_at )->format( 'd/m/Y H:i' ),
        ];
    }
}
