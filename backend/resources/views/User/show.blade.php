@extends('layouts.login.common')
@section('title', '投稿詳細')
@include('layouts.login.header')
@section('contents')

  <a type="button" class="btn btn-info back_btn" href="{{ route('top_main') }}">トップページへ</a>
  <br>
  <a type="button" class="btn btn-success back_btn" href="{{ route('userPostIndex') }}"
    style="margin-top:20px;">投稿一覧へ</a>
</p>
<p>
  @if(Auth::user()->contributorAndAdmin($posts_detail->user_id))
  <a type="button" class="btn btn-edit back_btn" href="{{ route('post.edit',[$posts_detail->id]) }}">投稿の編集　<i class="fas fa-edit"></i></a>
  @endif
</p>

<div class="item_detail">
    <ul class="item_detail_contents mt-5">
  <li>投稿者:{{ $posts_detail->user->username_kanji }}</li>
  <li class="item_detail_date">投稿日時:{{ $posts_detail->event_at->format('Y年m月d日') }}</li>
  <li class="item_detail_view">閲覧数:{{ $posts_detail->Actionlog->count() }}view</li>
  <li class="item_detail_title">タイトル:{{ $posts_detail->title }}</li>
  <li class="item_detail_post">{{ $posts_detail->post }}</li>
  <li class="item_detail_sub_category">{{ $posts_detail->postSubCategory->sub_category }}</li>
  <li class="item_detail_comment">コメント数:{{ $posts_detail->postComments->count() }}</li>
  <li class="item_detail_favorite_count">いいね数:
    <span id="post_favorite_count{{ $posts_detail->id }}">
        {{$posts_detail->userPostFavoriteRelation->count() }}
    </span>
  </li>

  <li class="item_detail_favorite" style="list-style: none;">
@if($posts_detail->postFavoriteIsExistence($posts_detail))
  <a class="post_favorite" post_id="{{ $posts_detail->id }}"
    post_favorite_id="0" style="color:#FF0000; text-decoration: none;">
    <i class="far fa-heart"></i>
  </a>
@else
  <a class="post_favorite" post_id="{{ $posts_detail->id }}"
    post_favorite_id="1" style="color:#FF0000; text-decoration: none;">
    <i class="fas fa-heart"></i>
  </a>
@endif
</li>
</ul>
</div>

@foreach($postComment as $postComment)

<div class="post_comment_list">
  <li class="comment_username">{{ $postComment->user->username_kanji }}さんが</li>
  <li class="comment_date">{{ $postComment->updated_at->format('Y年m月d日') }}にコメントしました。</li>
  <li class="comment_detail">{{ $postComment->comment }}</li>
  <li class="favorite_count">いいね数:
     <span id="comment_favorite_count{{ $postComment->id }}">
     {{ $postComment->comment_favorite_count }}
  </li>

  @if(!$postComment->postCommentFavoriteIsExistence(Auth::user()))
     <a class="comment_favorite" comment_id="{{ $postComment->id }}" post_id="{{ $postComment->post_id }}"
      comment_favorite_id="1" style="color:#FF0000; text-decoration: none;">
      <i class="far fa-heart"></i>
    </a>
  @else
    <a class="comment_favorite" comment_id="{{ $postComment->id }}" post_id="{{ $postComment->post_id }}"
      comment_favorite_id="0" style="color:#FF0000; text-decoration: none;">
      <i class="fas fa-heart"></i>
    </a>
  @endif

  @if (Auth::user()->contributorAndAdmin($postComment->user_id))
        <a href="{{ route('post_comment.edit',[$postComment->id]) }}">　
        <i class="fas fa-pen"></i></a>
  @endif
  @foreach($postComment->CommentsReplies as $comment_replies)
  <i class="fas fa-share replies_icon"></i>
    <div class="comment_replies">
        <li class="replies_username">{{ $comment_replies->user->username_kanji }}</li>
        <li class="replies_date">{{ $comment_replies->event_at->format('Y年m月d日') }}にコメントしました。</li>
        <li class="replies">{{ $comment_replies->comment_replies }}</li>
        @if (Auth::user()->contributorAndAdmin($comment_replies->user_id))
        <li class="replies_edit">
            <a href="{{ route('comment_replies.edit',[$comment_replies->id]) }}"><i class="fas fa-pen"></i>
            </a>
        </li>
  @endif
    </div>
  @endforeach
  </div>


@endforeach


<Form action="{{ route('post_comment_store',[$posts_detail->id]) }}" method="post" class="post_comment_request">
  @csrf
  <input class="comment_form" type="text" name="post_comment">
  <button class="comment_button" type="submit"><i class="fas fa-paper-plane" style="color: #ffffff" ></i></button>
</Form>

@endsection
@include('layouts.login.footer')
