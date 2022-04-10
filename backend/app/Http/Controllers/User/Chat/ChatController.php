<?php

namespace App\Http\Controllers\User\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat\ChatComment;
use Auth;

class ChatController extends Controller
{
    //
    public function index($id)
    {
        $chat_comments = ChatComment::where('send_user_id',$id)
        ->get();

        return view('Chat.chat')
        ->with('chat_comments',$chat_comments);
    }

    public function store(Request $request,$id)
    {

        // dd($request);
        $user = Auth::user();
        $chat_comments = $request->input('comment');

        ChatComment::create([
            'user_id' => $id,
            'send_user_id' -> $user->id,
            'name' => $user->username_kanji,
            'comment' => $chat_comments,
        ]);
        return redirect()->route('chat');
    }
}