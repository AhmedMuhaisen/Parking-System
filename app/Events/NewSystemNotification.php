<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class NewSystemNotification implements ShouldBroadcast
{ use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
 public $message;
    public function __construct( $userId,$message)
    {

   $this->message = $message;
        $this->userId = $userId;
    }

    public function broadcastOn():array
    {

        return[ new Channel('user.'.$this->userId)];

    }

    public function broadcastWith()
    {

        return ['message'=>$this->message,'user_id'=>$this->userId];
    }
}
