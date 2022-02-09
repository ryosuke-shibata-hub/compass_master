@extends('layouts.logout.common')
@section('title','ユーザー登録完了')
@include('layouts.logout.header')
@section('contents')

<div class="container pb-5" style="margin-bottom:25%;">
  <div class="row">
    <div class="col-md-12 col-md-offset-2 text-center">
      <h1 class="pt-5 pb-5">登録が完了しました！</h1>
      <a class="btn btn-success" href="{{ route('login') }}">
       ログイン画面へ
      </a>
    </div>
  </div>
</div>
@endsection
@include('layouts.logout.footer')
