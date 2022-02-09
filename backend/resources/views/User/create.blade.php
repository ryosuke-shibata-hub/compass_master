@extends('layouts.login.common')
@section('title','投稿ページ')
@include('layouts.login.header')
@section('contents')
<a href="{{ route('userPostIndex') }}">戻る</a>

<Form action="{{ route('post.store') }}" method="post">
@csrf
<label>カテゴリー</label>
<select name="post_sub_category_id">
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

<label>タイトル</label>
<input type="text" name="title">
<label>投稿内容</label>
<input type="text" name="post">
<button type="submit">登録</button>
</Form>
@endsection
@include('layouts.login.footer')
