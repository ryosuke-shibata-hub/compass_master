@extends('layouts.login.common')
@section('title','投稿の編集')
@include('layouts.login.header')
@section('contents')
<p>
  <a href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  <a href="{{ route('post_show',[$posts_detail->id]) }}">戻る</a>
</p>

<Form action="{{ route('post.update',[$posts_detail->id]) }}" method="post">
  @method('PUT')
  @csrf
  <label>カテゴリー</label>
  <select name="post_sub_category_id">
    <option value="">----</option>
      @foreach($post_main_category as $post_main_category)
        <optgroup label="{{ $post_main_category->main_category }}">
          @foreach($post_main_category->postSubCategory as $post_sub_category)
            <option value="{{ $post_sub_category->id }}"
              @if(old('post_sub_category_id',$post_sub_category->id==$posts_detail->post_sub_category_id))
              selected @endif>
              {{ $post_sub_category->sub_category }}
            </option>
          @endforeach
        </optgroup>
      @endforeach
  </select>

  <label>タイトル</label>
  <input type="text" name="title" value="{{ $posts_detail->title }}">

  <label>投稿内容</label>
  <input type="text" name="post" value="{{ $posts_detail->post }}">
  <button type="submit">編集</button>
</Form>
@if($posts_detail->postCommentIsExistence($posts_detail))
<Form action="{{ route('post.destroy',[$posts_detail->id]) }}" method="post">
  @method('DELETE')
  @csrf
  <button class="btn-dell" type="submit">投稿の削除</button>
</Form>
@endif
@endsection
@include('layouts.login.footer')
