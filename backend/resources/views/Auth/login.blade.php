@extends('layouts.logout.common')
@section('title', 'ログインページ')
@include('layouts.logout.header')
@section('contents')

@if(session('login_erro'))
  <span class="text_danger">
    {{ session('login_erro') }}
  </span>
@endif
    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="mb-3 text-center pb-5">
        <label for="exampleInputEmail1" class="form-label pb-5">メールアドレス</label>
        <input style="margin-left:38%;" type="email" name="email" class="form-control mb-5 w-25" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3 text-center">
        <label for="exampleInputPassword1" class="form-label pb-5">パスワード</label>
        <input style="margin-left:38%;" type="password" name="password" class="form-control mb-5 w-25" id="exampleInputPassword1">
      </div>
      <div class="mb-3 form-check" style="margin-left:55%;">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label mb-5" for="exampleCheck1">Check me out</label>
      </div>
      <button type="submit" style="margin-left:58%;" class="btn btn-primary">ログイン</button>
    </form>

    <p style="margin-top:100px; margin-left:47%;">
      <span>
        <a href="{{ route('register.form') }}"
          type="button" class="btn btn-secces">新規ユーザーはこちら</a>
        </span>
    </p>



@endsection
@include('layouts.logout.footer')
