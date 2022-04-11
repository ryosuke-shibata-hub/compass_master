@extends('layouts.login.common')
@section('title','チャット')
@include('layouts.login.header')
@section('contents')
<div class="main_chat_box">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>

    {{--  チャットルーム  --}}
    <div id="room">
        @foreach($chat_comments as $key => $message)
            {{--   送信したメッセージ  --}}
            @if($message->send_user_id == Auth::id())
                <div class="send" style="text-align: right">
                    <p>{{$message->comment}}</p>
                </div>

            @endif

            {{--   受信したメッセージ  --}}
            @if($message->receive == Auth::id())
                <div class="recieve" style="text-align: left">
                    <p>{{$message->comment}}</p>
                </div>
            @endif
        @endforeach
    </div>

    <form>
        <textarea name="message" style="width:100%"></textarea>
        <button type="button" id="btn_send">送信</button>
    </form>

    <input type="hidden" name="send" value="{{ $chat_comments->user_id }}">
    <input type="hidden" name="recieve" value="{{$chat_comments->send_user_id}}">
    <input type="hidden" name="login" value="{{Auth::id()}}">

</div>


</div>

@endsection
@include('layouts.login.footer')
