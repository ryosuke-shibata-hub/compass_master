@extends('layouts.login.common')
@section('title', '質問箱')
@include('layouts.login.header')
@section('contents')

<div class="home_index_page">
    <div class="question_list">
        <div class="question_main">
            @if($question_lists->count() > 0)
                    @else
                    <div class="non_post">
                        該当の投稿はありません....💬
                    </div>
                    @endif
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
                                <form action="{{ route('question_index') }}" method="get" class="search-questio-form">
                                    @csrf
                                <div class="status">
                                    <button class="answer_under_recruitment question_status_btn" name="question_Status" value="2">回答募集中</button>
                                    @if($question_lists->question_status == 1)
                                        <button class="answer_close question_status_btn" name="question_Status" value="1">解決済み</button>
                                    @endif
                                </div>
                                </form>
                            </div>
                        </div>
                        <a class="question_detail_link" href="{{ route('question_detail',[$question_lists->id]) }}">
                            <h3 class="question_title">{{ $question_lists->title }}</h3>
                        </a>
                    </div>
                    <div class="question_sub">
                        <div class="question_tag">
                            <form action="{{ route('question_index') }}" method="GET">
                                <i class="fas fa-tags"></i>
                                    <button type="submit" class="post_tag_title"
                                        value="{{ $question_lists->tag_id }}" name="tag_id">
                                        {{ $question_lists->questionTagCategory->question_tag }}
                                    </button>
                            </form>
                        </div>
                        <div class="question_categories_detail">
                            <div class="answer_count">
                                <span>回答件数</span>
                                <span class="answer_count_detail">{{ $question_lists->answer->count() }}件</span>
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
            <div class="search_input pb-5">
                <a href="/question_post" class="btn btn-primary question_post" type="button">
                    質問する
                </a>
                <form action="{{ route('question_index') }}" method="get" class="search-questio-form">
                    @csrf
                    <button type="submit" class="btn btn-danger search_reset"
                        value="search_reset" name="search_reset">リセット</button>
                    <input type="text" class="question_search" name="question_keyword"
                        placeholder="キーワードを入力">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <p class="tag">タグランキング</p>
            <div class="tag_title">
                <form action="{{ route('question_index') }}" method="GET">
                    @foreach($tag_list as $tag_list)
                    <button type="submit" class="tag_title"
                        value="{{ $tag_list->id }}" name="tag_id">
                        <img class="tag_logo" style="width:15px;" src="/uploads/question_tag/{{ $tag_list->tag_logo }}">　
                        {{ $tag_list->question_tag }}
                    </button>
                @endforeach
                </form>

            </div>
        </section>
    </div>
    <div class="user_ranking"></div>
</div>

@endsection
@include('layouts.login.footer')
