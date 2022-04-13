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
        @foreach($chat_comment as $key => $message)
            {{--   送信したメッセージ  --}}
            @if($message->send_user_id == Auth::user()->id)
                <div class="send" style="text-align: right">
                    <p>{{$message->comment}}</p>
                </div>

            @endif

            {{--   受信したメッセージ  --}}
            @if($message->recieve_user_id == Auth::user()->id)
                <div class="recieve" style="text-align: left">
                    <p>{{$message->comment}}</p>
                </div>
            @endif
        @endforeach
    </div>

    <form>
        <textarea name="comment" style="width:100%"></textarea>
        <button type="button" id="btn_send">送信</button>
    </form>

    <input type="hidden" name="send" value="{{ $param['send_user_id'] }}">
    <input type="hidden" name="recieve" value="{{$param['recieve_user_id']}}">
    <input type="hidden" name="login" value="{{Auth::user()->id}}">

</div>


</div>
    <script src="https://js.pusher.com/7.0/pusher.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.js"></script>
@endsection
@include('layouts.login.footer')
