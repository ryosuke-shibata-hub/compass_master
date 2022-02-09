@extends('layouts.logout.common')
@section('title','ユーザー登録ページ')
@include('layouts.logout.header')
@section('contents')

<form action="{{ route('register') }}" method="post">
  @csrf
  <div class="mb-3 text-center pb-5">
    <label class="form-label pb-3">ユーザー名</label>
    <input class="form-control w-25 pm-5" style="margin-left:38%;"
      type="text" name="username" value="{{ old('username') }}">
    @if($errors->has('username'))
    <span class="text-danger">{{ $errors->first('username') }}</span>
    @endif

    <label class="form-label pb-3 pt-5">メールアドレス</label>
    <input class="form-control w-25 pm-5" style="margin-left:38%;"
      type="email" name="email" value="{{ old('email') }}">
    @if($errors->has('email'))
    <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif

    <label class="form-label pb-3 pt-5">パスワード</label>
    <input class="form-control w-25 pm-5" style="margin-left:38%;"
      type="password" name="password">
    @if($errors->has('password'))
    <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif
    <label class="form-label pb-3 pt-5">パスワード確認</label>
    <input class="form-control w-25 pm-5" style="margin-left:38%;"
      type="password" name="password_confirmed">

    <a href="{{ route('login') }}" style="margin-right:18%;" type="button" class="btn btn-succes mt-5">戻る</a>
    <button type="submit" class="btn btn-primary mt-5">登録</button>
  </div>
</form>

@endsection
@include('layouts.logout.footer')
