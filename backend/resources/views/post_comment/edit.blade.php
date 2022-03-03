@extends('layouts.login.common')
@section('title','コメントの編集')
@include('layouts.login.header')
@section('contents')

<p>
  <a type="button" class="btn btn-info back_btn" href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  <a type="button" class="btn btn-dark back_btn" href="{{ route('post_show',[$post_comment_detail->post_id]) }}">戻る</a>
</p>

<div class="edit_item">
<Form action="{{ route('post_comment.update',[$post_comment_detail->id]) }}" method="post">
@method('PUT')
@csrf
<label class=" pt-5">コメント</label>
<input class="create_item w-50 edit_comment_form" type="text" name="comment" value="{{ $post_comment_detail->comment }}">
<div class="create_form_btn">
<button class="btn btn-outline-success comment_edit_btn" type="submit">編集</button>
</div>
</Form>
<Form action="{{ route('post_comment.destroy',[$post_comment_detail->id]) }}" method="post">
@method('DELETE')
@csrf
<div class="comment_delete_btn">
    <button class="btn btn-outline-danger btn-dell" type="submit">コメントの削除</button>
</div>
</Form>
@endsection
</div>
@include('layouts.login.footer')
