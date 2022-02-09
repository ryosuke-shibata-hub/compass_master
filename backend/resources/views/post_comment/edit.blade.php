@extends('layouts.login.common')
@section('title','コメントの編集')
@include('layouts.login.header')
@section('contents')

<p>
  <a href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  <a href="{{ route('post_show',[$post_comment_detail->post_id]) }}">戻る</a>
</p>

<Form action="{{ route('post_comment.update',[$post_comment_detail->id]) }}" method="post">
@method('PUT')
@csrf
<label>コメント</label>
<input type="text" name="comment" value="{{ $post_comment_detail->comment }}">
<button type="submit">編集</button>
</Form>
<Form action="{{ route('post_comment.destroy',[$post_comment_detail->id]) }}" method="post">
@method('DELETE')
@csrf
<button type="submit">コメントの削除</button>
</Form>
@endsection
@include('layouts.login.footer')
