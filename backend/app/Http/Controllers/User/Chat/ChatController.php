<?php

namespace App\Http\Controllers\User\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat\ChatComment;
use Auth;
use App\Models\Users\User;
use App\Mail\SampleNotification;
use App\Events\ChatMessageRecieved;
use Carbon\Carbon;
use Log;

class ChatController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->get();
        // チャットユーザ選択画面を表示
        return view('Chat.chat_top')
        ->with('users',$users);
    }

    public function show(Request $request,$recieve)
    {
        $loginId = Auth::id();

        $param = [
            'send_user_id' => $loginId,
            'recieve_user_id' => $recieve,
        ];
// dd($param);
        $query = ChatComment::where('send_user_id',$loginId)
        ->where('recieve_user_id',$recieve);
        $query->orWhere(function($query)use($loginId,$recieve) {
            $query->where('send_user_id',$recieve);
            $query->where('recieve_user_id',$loginId);
        });

        $chat_comment = $query->get();
// dd($chat_comment);
        return view('Chat.chat')
        ->with('param',$param)
        ->with('chat_comment',$chat_comment);
    }

    public function store(Request $request)
    {
        try{

            $insertParam = [
            'send_user_id' => $request->input('send'),
            'recieve_user_id' => $request->input('recieve'),
            'comment' => $request->input('comment'),
            'created_at' =>  $request->input('created_at'),
        ];
            ChatComment::insert($insertParam);

            event(new ChatMessageRecieved($request->all()));

            return true;
        }catch (\Exception $e){

            return false;
        }




    }
}