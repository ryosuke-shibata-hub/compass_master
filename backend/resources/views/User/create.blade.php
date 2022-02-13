@extends('layouts.login.common')
@section('title','投稿ページ')
@include('layouts.login.header')
@section('contents')

<a class="btn btn-dark back_btn" type="button" href="{{ route('userPostIndex') }}">戻る</a>

<div class="edit_item">
    <Form action="{{ route('post.store') }}" method="post">
@csrf
<label>カテゴリー</label>
<select class="create_item w-50" style="height:50px;" name="post_sub_category_id">
  <option value="----"></option>
  @foreach($post_main_categories as $main_data)
  <optgroup label="{{ $main_data->main_category }}">
    @foreach($main_data->postSubCategory as $sub_data)
    <option value="{{ $sub_data->id }}">
      {{ $sub_data->sub_category }}
    </option>
    @endforeach
  </optgroup>
  @endforeach
</select>

<label class=" pt-5">タイトル</label>
<input class="create_item w-50" style="height:50px;" type="text" name="title">
<label class=" pt-5">投稿内容</label>
<input class="create_item w-50 create_item_form" type="text" name="post">
<div class="create_form_btn">
    <button type="submit" class="btn btn-outline-success post_register_btn">登録</button>
</div>
</Form>
</div>



@endsection
@include('layouts.login.footer')
