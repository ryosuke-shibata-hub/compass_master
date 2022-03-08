@extends('layouts.login.common')
@section('title','管理者画面')
@include('layouts.login.header')
@section('contents')

<a type="button" class="btn btn-info back_btn" href="{{ route('userPostIndex') }}">トップページへ</a>
<div class="main_content">
    <div class="main_nav pb-5">
        <div class="create_new_user">
        <a href="create/new/user" class="btn btn-success" type="buttom">
            新規ユーザーの作成
        </a>
    </div>
    <div class="update_user pt-5">
        <a href="update/user" class="btn btn-primary" type="buttom">
            ユーザー情報の編集
        </a>
    </div>
    <div class="delete_user pt-5">
        <a href="delete/user" class="btn btn-danger" type="buttom">
            ユーザー情報の削除
        </a>
    </div>
    </div>
</div>
@endsection
@include('layouts.login.footer')
