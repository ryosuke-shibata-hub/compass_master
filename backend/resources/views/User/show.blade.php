@extends('layouts.login.common')
@section('title', '投稿詳細')
@include('layouts.login.header')
@section('contents')

<p>
  <a href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  @if(Auth::user()->contributorAndAdmin($posts_detail->user_id))
  <a href="{{ route('post.edit',[$posts_detail->id]) }}">投稿の編集</a>
  @endif
</p>

<ul>
  <li>{{ $posts_detail->user->username }}</li>
  <li>{{ $posts_detail->event_at }}</li>
  <li>閲覧数:{{ $posts_detail->Actionlog->count() }}view</li>
  <li>{{ $posts_detail->title }}</li>
  <li>{{ $posts_detail->postSubCategory->sub_category }}</li>
  <li>コメント数:{{ $posts_detail->postComments->count() }}</li>
  <li>いいね数:{{ $posts_detail->userPostFavoriteRelation->count() }}</li>
</ul>


<li style="list-style: none;">
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


<Form action="{{ route('post_comment_store',[$posts_detail->id]) }}" method="post">
  @csrf
  <input type="text" name="post_comment">
  <button type="submit">コメントする</button>
</Form>

@foreach($posts_detail->postComments as $postComment)

  <p>{{ $postComment->user->username }}</p>
  <p>{{ $postComment->comment }}</p>
  <p>{{ $postComment->event_at }}</p>

  @if($posts_detail->postCommentFavoriteIsExistence($posts_detail))
    <a class="comment_favorite" comment_id="{{ $postComment->id }}"
      comment_favorite_id="0" style="color:#FF0000; text-decoration: none;">
      <i class="far fa-heart"></i>
    </a>
  @else
    <a class="comment_favorite" comment_id="{{ $postComment->id }}"
      comment_favorite_id="1" style="color:#FF0000; text-decoration: none;">
      <i class="fas fa-heart"></i>
    </a>
  @endif
  <p>いいね数:{{ $posts_detail->userCommentFavoriteRelation->count() }}</p>
  @if (Auth::user()->contributorAndAdmin($postComment->user_id))
        <a href="{{ route('post_comment.edit',[$postComment->id]) }}">
        コメントの編集</a>
  @endif
@endforeach

@endsection
@include('layouts.login.footer')
