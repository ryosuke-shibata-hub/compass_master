@extends('layouts.login.common')
@section('title', '質問箱')
@include('layouts.login.header')
@section('contents')

<div class="home_index_page">
    <div class="question_list">
        <div class="question_main">
            <section class="question_section">
                @foreach($question_lists as $question_lists)
                    <article class="question_detail">
                    <section class="question_user">
                        <div class="user_detail">
                            <a href="" class="">
                                <img src="/uploads/{{ $question_lists->user->logo }}" class="" style="width: 20px;">
                                <p class="username">
                                    {{ $question_lists->user->username_kanji  }}さんが
                                </p>
                            </a>
                            <p class="question_date">
                                {{ $question_lists->event_at->format('Y年m月d日') }}に投稿しました。
                            </p>
                        </div>
                    </section>
                    <div class="question_title">
                        <div class="question_status">
                            <div class="question_status_box">
                                <div class="status">
                                    <a href="" class="answer_under_recruitment">回答募集中</a>
                                    <a href="" class="answer_close">解決済み</a>
                                </div>
                            </div>
                        </div>
                        <h3 class="question_title">{{ $question_lists->title }}</h3>
                    </a>
                    </div>
                    <div class="question_sub">
                        <div class="question_tag">
                            <i class="fas fa-tags"></i>
                            <a href="" class="">
                                {{ $question_lists->questionTagCategory->question_tag  }}
                            </a>

                        </div>
                        <div class="question_categories_detail">
                            <div class="answer_count">
                                <span>回答件数</span>
                                <span class="answer_count_detail">12</span>
                            </div>
                        </div>
                    </div>

                </article>
                @endforeach
            </section>
        </div>
    </div>
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
