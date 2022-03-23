@extends('layouts.login.common')
@section('title', 'プロフィール編集')
@include('layouts.login.header')
@section('contents')

<a class="btn btn-dark back_btn" type="button" href="{{ route('mypage') }}">戻る</a>

<p class="text-center">プロフィール編集</p>
<div class="edit_item" style="margin-left:100px;">
    <Form action="{{ route('mypage_update') }}" method="post"
        enctype="multipart/form-data">
    @csrf
    <div class="mypage_box">
        <label class="file_upload">
            <input type="file" name="logo" style="display:none"
            value="{{ Auth::user()->logo }}">
            @if(!empty(Auth::user()->logo))
                <img src="/uploads/{{ Auth::user()->logo }}">
            @else
                <img style="width:50px;" src="/uploads/user-regular-2.svg">
            @endif

        </label>
        <br>
        <li class="username">ユーザーネーム</li>
        <input type="text" name="username" value="{{ Auth::user()->username_kanji }}">
        <li class="email pt-5">登録メールアドレス</li>
        <input type="email" name="email" value="{{ Auth::user()->email }}">
        <br>
        <li class="password pt-5">パスワード変更</li>
        <input type="password" name="password" style="">
        <br>
        <br>
        <li class="password">パスワード確認</li>
        <input type="password" name="password_confirmed" style="">
        <br>
        <button class="mt-5 btn btn-link" type="submit"><i class="fas fa-user-edit"></i></button>
    </div>

    </Form>
</div>

@endsection
@include('layouts.login.footer')
