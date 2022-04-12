<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageRecieved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $chat_comment;
    protected $request;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
    public function broadcastOn()
    {

        return new Channel('chat');

    }

     /**
     * ブロードキャストするデータを取得
     *
     * @return array
     */
    public function broadcastWith()
    {

        return [
            'comment' => $this->request['comment'],
            'send' => $this->request['send'],
            'recieve' => $this->request['recieve'],
        ];
    }

    /**
     * イベントブロードキャスト名
     *
     * @return string
     */
    public function broadcastAs()
    {

        return 'chat_event';
    }

}