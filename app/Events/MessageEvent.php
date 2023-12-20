<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiver_id;
    public $date_time;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $receiver_id, $date_time)
    {
        $this->message = $message;
        $this->receiver_id = $receiver_id;
        $this->date_time = $date_time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('message.' . $this->receiver_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'sender_id' => Auth::user()->id,
            'receiver_id' => $this->receiver_id,
            'user_image' => asset(Auth::user()->image),
            'date_time' => $this->date_time,
            'vendor_banner' => (isset(Auth::user()->vendor->banner) ?  asset(Auth::user()->vendor->banner) : asset(Auth::user()->image))
        ];
    }
}
