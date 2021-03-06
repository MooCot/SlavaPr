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
use App\Models\User;

class TaskEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Task $task;
    public int $userid;
    public array $usersid;
    public array $tokens;
    public string $notification;
    public string $extraNotificationData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function sendOne(Task $task, User $user, array $tokens, string $notification, string $extraNotificationData)
    {
        $this->task = $task;
        $this->userid = $user->id;
        $this->tokens = $tokens;
        $this->notification = $notification;
        $this->extraNotificationData = $extraNotificationData;
    }

    public function sendAll(Task $task, array $usersid, array $tokens, string $notification, string $extraNotificationData)
    {
        $this->task = $task;
        $this->usersid = $usersid;
        $this->tokens = $tokens;
        $this->notification = $notification;
        $this->extraNotificationData = $extraNotificationData;
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
