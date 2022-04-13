<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Chat\ChatComment;

class ChatMessageRecieved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // protected $comment;
    // protected $request;
    public $insertParam;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct($request)
    // {
    //     //
    //     $this->request = $request;
    // }
    public function __construct(ChatComment $chatComment)
    {
        //
        $this->chatComment = $chatComment;
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
    //  * @return array
    //  */
    // public function broadcastWith()
    // {

    //     return [
    //         'comment' => $this->request['comment'],
    //         'send' => $this->request['send'],
    //         'recieve' => $this->request['recieve'],
    //     ];
    // }

    // /**
    //  * イベントブロードキャスト名
    //  *
    //  * @return string
    //  */
    // public function broadcastAs()
    // {
    //     return 'chat_event';
    // }

}