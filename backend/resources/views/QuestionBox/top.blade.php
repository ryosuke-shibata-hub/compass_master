@extends('layouts.login.common')
@section('title', '質問箱')
@include('layouts.login.header')
@section('contents')
<div class="home_index_page">
    <div class="question_list"></div>
    <div class="question_tags">
        <section class="tag_list">
            <p class="tag">タグランキング</p>
            <div class="tag_title">
                @foreach($tag_list as $tag_list)
                    <a class="tag_title" href="{{ $tag_list->id }}">
                        <img class="tag_logo" style="width:15px;" src="/uploads/question_tag/{{ $tag_list->tag_logo }}">　
                        {{ $tag_list->question_tag }}</a>
                @endforeach
            </div>
        </section>
    </div>
    <div class="user_ranking"></div>
</div>

@endsection
@include('layouts.login.footer')
