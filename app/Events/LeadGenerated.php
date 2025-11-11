<?php


namespace App\Events;

use App\Models\LeadGenrate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadGenerated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lead;

    public function __construct(LeadGenrate $lead)
    {
        $this->lead = $lead;
    }

    public function broadcastOn()
    {
        return new Channel('my-channal'); // Ensure this matches the Pusher channel in your JavaScript
    }

    public function broadcastAs()
    {
        return 'my-event'; // Ensure this matches the event name in your JavaScript
    }
}