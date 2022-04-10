@extends('layouts.login.common')
@section('title','チャット')
@include('layouts.login.header')
@section('contents')
<div class="main_chat_box">

        <div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">Chat</div>
            <div class="card-body chat-card">
                @foreach($chat_comments as $items)
                    @include('components.chat_comment',['item'=>$items])
                @endforeach

            </div>
        </div>
    </div>
    </div>
    <form action="{{ route('chat_store') }}" method="post">
        @csrf
                <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" placeholder="input massage" aria-label="With textarea" name="comment"></textarea>
            <button type="input-group-prepend button" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>
    </form>

</div>

@endsection
@include('layouts.login.footer')
