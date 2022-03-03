@extends('layouts.login.common')
@section('title','投稿の編集')
@include('layouts.login.header')
@section('contents')

<p>
  <a type="button" class="btn btn-info back_btn" href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  <a type="button" class="btn btn-dark back_btn" href="{{ route('post_show',[$posts_detail->id]) }}">戻る</a>
</p>

<div class="edit_item">

<Form action="{{ route('post.update',[$posts_detail->id]) }}" method="post">
  @method('PUT')
  @csrf
  <label>カテゴリー</label>
  <select class="create_item w-50" style="height:50px;" name="post_sub_category_id">
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

  <label class=" pt-5">タイトル</label>
  <input class="create_item w-50" style="height:50px;" type="text" name="title" value="{{ $posts_detail->title }}">

  <label class=" pt-5">投稿内容</label>
  <input class="create_item w-50 create_item_form" type="text" name="post" value="{{ $posts_detail->post }}">
  <div class="create_form_btn">
    <button class="btn btn-outline-success post_register_btn" type="submit">編集</button>
  </div>

</Form>

@if($posts_detail->postCommentIsExistence($posts_detail))
<Form action="{{ route('post.destroy',[$posts_detail->id]) }}" method="post">
  @method('DELETE')
  @csrf
  <div class="post_delete_btn">
    <button class="btn btn-outline-danger btn-dell" type="submit">投稿の削除</button>
  </div>
</Form>
@endif
</div>
@endsection
@include('layouts.login.footer')
