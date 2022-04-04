@extends('layouts.login.common')
@section('title', '質問')
@include('layouts.login.header')
@section('contents')
<style >
    pre {background-color: #232323; color: #ffffff; padding: 5px;}
</style>
<div class="question_show_detail">
    <div class="question_main_box">
        <div class="question_box_detail">
            <div class="question_owner">
                <a href="" class="">
                    <img src="/uploads/{{ $question_detail->user->logo }}" class="" style="width: 30px;">
                    <p class="username">
                        {{ $question_detail->user->username_kanji  }}さんが
                    </p>
                </a>
                    <p class="question_date">
                        {{ $question_detail->event_at->format('Y年m月d日') }}に投稿しました。
                    </p>
            </div>
            <div class="contents_title">
                <h2>{{ $question_detail->title }}</h2>
            </div>
            <div class="question_sub_contents">
                <div class="question_status">
                    <div class="question_status_box">
                        <div class="status">
                            <a href="" class="answer_under_recruitment">Q&A</a>
                            @if($question_detail->question_status == 1)
                                <a href="" class="answer_close">Close</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="question_tag">
                    <form action="{{ route('question_index') }}" method="GET">
                        <tr class="box" style="width: 30px;">　</tr>
                        <i class="fas fa-tags"></i>
                            <button type="submit" class="post_tag_title"
                                value="{{ $question_detail->tag_id }}" name="tag_id">
                                {{ $question_detail->questionTagCategory->question_tag }}
                            </button>
                    </form>
                </div>
            </div>
            <div class="question_contents">
                <div class="question_contents_item">
                    {{ $markdown }}
                </div>
            </div>

        </div>

        <div class="question_box_answer"></div>



        <div class="answer_text_box">
            <form action="{{ route('question_comment',[$question_detail->id]) }}" method="post">
                @csrf
                <div class="comment_box">
                    <div class="question_nav">
                        <p class="comment_title">コメントする</p>
                        <button type="submit" class="btn btn-primary question_store_btn">投稿</button>
                    </div>

                    <div class="input_area">
                        <div>
                            <div class="comment_form_area">
                                <textarea class="text_area" id="body" name="name" rows="8" cols="40"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>
var simplemde = new SimpleMDE({ element: document.getElementById("body") });
</script>
@endsection
@include('layouts.login.footer')
