<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;
class TaskEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Task $task;
    public array $token;
    public string $notification;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task, array $token, string $notification)
    {
        $this->task = $task;
        $this->token = $token;
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}