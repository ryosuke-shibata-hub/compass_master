@extends('layouts.login.common')
@section('title','ユーザー登録')
@include('layouts.login.header')
@section('contents')

<form action="{{ route('user_create_register') }}" method="post">
  @csrf
  <div class="mb-3 pb-5">
    <div class="kanji_username_form">
        <label class="form-label title">ユーザー名(姓、名)</label>
        <input class="form-control  user_detail_input" style="margin-left:40%;"
        type="text" name="firstname_kanji" value="{{ old('firstname_kanji') }}" placeholder="姓">
        <input class="form-control user_detail_input" style="margin-left:52%;"
        type="text" name="lastname_kanji" value="{{ old('lastname_kanji') }}" placeholder="名">

        @if($errors->has('firstname_kanji'))
        <span class="text-danger register-admin-danger">{{ $errors->first('firstname_kanji') }}</span>
        @endif
        @if($errors->has('lastname_kanji'))
        <span class="text-danger register-admin-danger">{{ $errors->first('lastname_kanji') }}</span>
        @endif
    </div>

    <div class="kana_username_form pt-5">
        <label class="form-label title">ユーザー名(セイ、メイ)</label>
        <input class="form-control  user_detail_input" style="margin-left:40%;"
        type="text" name="firstname_kana" value="{{ old('firstname_kana') }}"
        placeholder="セイ">
        <input class="form-control user_detail_input" style="margin-left:52%;"
        type="text" name="lastname_kana" value="{{ old('lastname_kana') }}" placeholder="メイ">

        @if($errors->has('firstname_kana'))
        <span class="text-danger register-admin-danger">{{ $errors->first('firstname_kana') }}</span>
        @endif
        @if($errors->has('lastname_kana'))
        <span class="text-danger register-admin-danger">{{ $errors->first('lastname_kana') }}</span>
        @endif
    </div>

    <div class="birthday pt-5">
        <label class="form-label title">誕生日</label>
        <input class="form-control  user_detail_input input_date" style="margin-left:40%;"
        type="text" name="birthday_year" value="{{ old('birthday_year') }}" placeholder="年">
        <input class="form-control user_detail_input input_date" style="margin-left:48%;"
        type="text" name="birthday_month" value="{{ old('birthday_month') }}" placeholder="月">
        <input class="form-control user_detail_input input_date" style="margin-left:56%;"
        type="text" name="birthday_day" value="{{ old('birthday_day') }}" placeholder="日">
        {{-- @if($errors->has('username'))
        <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif --}}
    </div>

    <div class="Admission_date pt-5">
        <label class="form-label title">入学日</label>
        <input class="form-control  user_detail_input input_date" style="margin-left:40%;"
        type="text" name="Admission_year" value="{{ old('Admission_year') }}" placeholder="年">
        <input class="form-control user_detail_input input_date" style="margin-left:48%;"
        type="text" name="Admission_month" value="{{ old('Admission_month') }}" placeholder="月">
        <input class="form-control user_detail_input input_date" style="margin-left:56%;"
        type="text" name="Admission_day" value="{{ old('Admission_day') }}" placeholder="日">
        {{-- @if($errors->has('username'))
        <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif --}}
    </div>

    <div class="gender pt-5">
        <label class="form-label">男性</label>
        <input class=""
        type="radio" name="gender" value="0">
        <label class="form-label">女性</label>
        <input class=""
        type="radio" name="gender" value="1">
    </div>

    <div class="email pt-5">
        <label class="form-label title">メールアドレス</label>
        <input class="form-control w-25" style="margin-left:40%;"
        type="email" name="email" value="{{ old('email') }}">
        @if($errors->has('email'))
        <span class="text-danger register-admin-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

   <div class="password pt-3">
        <label class="form-label title">パスワード</label>
        <input class="form-control w-25" style="margin-left:40%;"
        type="password" name="password">
        @if($errors->has('password'))
        <span class="text-danger register-admin-danger">{{ $errors->first('password') }}</span>
        @endif
   </div>

   <div class="password_confirmed pt-3">
        <label class="form-label title">パスワード確認</label>
        <input class="form-control w-25" style="margin-left:40%;"
        type="password" name="password_confirmed">
   </div>

    <div class="admin_role pt-3">
        <p style="margin-left: -10%;">権限</p>
        <label class="form-label">国語教師</label>
        <input type="radio" value="0" name="role">
         <label class="form-label">数学教師</label>
        <input type="radio" value="5" name="role">
         <label class="form-label">生徒</label>
        <input type="radio" value="10" name="role">
   </div>

    <div class="Japanese_language_staff pt-3">
        <p>国語担当者</p>
        <label class="form-label" style="margin-left: 80px">国語教師1</label>
        <input type="radio" value="" name="role">
        <label class="form-label">国語教師2</label>
        <input type="radio" value="" name="role">
   </div>

   <div class="math_language_staff pt-3">
        <p>数学担当者</p>
        <label class="form-label" style="margin-left: 80px">数学教師1</label>
        <input type="radio" value="" name="role">
         <label class="form-label">数学教師2</label>
        <input type="radio" value="" name="role">
   </div>

   <div class="info_btn" style="margin-left:40%;">
        <a href="{{ route('Administrator' )}}" style="margin-right:30%;" type="button" class="btn btn-succes mt-5">戻る</a>
        <button type="submit" class="btn btn-primary mt-5">登録</button>
   </div>


  </div>
</form>

@endsection
@include('layouts.login.footer')
