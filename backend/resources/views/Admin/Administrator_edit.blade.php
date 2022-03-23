@extends('layouts.login.common')
@section('title','ユーザー編集')
@include('layouts.login.header')
@section('contents')
<div class="main_content">
    <div class="row">

<form action="{{ route('admin_user.update',[$user->id]) }}" method="POST">
  @csrf
  @method('PATCH')
  <div class="mb-3 pb-5">
    <div class="kanji_username_form">
        <label class="form-label title">ユーザー名</label>
        <input class="form-control  user_detail_input" style="margin-left:40%;"
        type="text" name="username_kanji" value="{{ $user->username_kanji }}">

        @if($errors->has('username_kanji'))
        <span class="text-danger register-admin-danger">{{ $errors->first('username_kanji') }}</span>
        @endif
    </div>

    <div class="kana_username_form pt-5">
        <label class="form-label title">ユーザー名</label>
        <input class="form-control  user_detail_input" style="margin-left:40%;"
        type="text" name="username_kana" value="{{ $user->username_kana }}">
        @if($errors->has('username_kana'))
        <span class="text-danger register-admin-danger">{{ $errors->first('username_kana') }}</span>
        @endif
    </div>

    <div class="birthday pt-5">
        <label class="form-label title">誕生日</label>
        <input class="form-control  user_detail_input input_date" style="margin-left:40%;"
        type="text" name="birthday_year" value="{{ $user->birthday->format('Y') }}">
        <input class="form-control user_detail_input input_date" style="margin-left:48%;"
        type="text" name="birthday_month" value="{{ $user->birthday->format('m') }}">
        <input class="form-control user_detail_input input_date" style="margin-left:56%;"
        type="text" name="birthday_day" value="{{ $user->birthday->format('d') }}">
    </div>

    <div class="Admission_date pt-5">
        <label class="form-label title">入学日</label>
        <input class="form-control  user_detail_input input_date" style="margin-left:40%;"
        type="text" name="Admission_year" value="{{ $user->AdmissionDay->format('Y') }}">
        <input class="form-control user_detail_input input_date" style="margin-left:48%;"
        type="text" name="Admission_month" value="{{ $user->AdmissionDay->format('m') }}">
        <input class="form-control user_detail_input input_date" style="margin-left:56%;"
        type="text" name="Admission_day" value="{{ $user->AdmissionDay->format('d') }}">
    </div>

    <div class="gender pt-5">
        <label class="form-label">男性</label>
        <input class=""
        type="radio" name="gender" value="0">
        <label class="form-label">女性</label>
        <input class=""
        type="radio" name="gender" value="1">
        @if($errors->has('gender'))
        <span class="text-danger register-admin-danger">{{ $errors->first('gender') }}</span>
        @endif
    </div>

    <div class="email pt-5">
        <label class="form-label title">メールアドレス</label>
        <input class="form-control w-25" style="margin-left:40%;"
        type="email" name="email" value="{{ $user->email }}">
        @if($errors->has('email'))
        <span class="text-danger register-admin-danger">{{ $errors->first('email') }}</span>
        @endif
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
        @foreach($japanies_teacher as $japanies_teacher)
                    <label class="japanese_language_select">
                        <li class="japanese_language">
                            {{ $japanies_teacher->username_kanji }}
                        </li>
                    </label>
                    <input type="radio" value="{{ $japanies_teacher->id }}" name="Japanese_language_staff_role">
        @endforeach
    </div>

    <div class="math_language_staff pt-3">
        <p>数学担当者</p>
        @foreach($math_teacher as $math_teacher)
            <label class="math_teacher_select">
                <li class="math_teacher">
                    {{ $math_teacher->username_kanji }}
                </li>
            </label>
            <input type="radio" value="{{ $math_teacher->id }}" name="math_language_staff_role">
        @endforeach
    </div>

   <div class="info_btn" style="margin-left:40%;">
        <a href="{{ route('Admin_user_show' )}}" style="margin-right:30%;" type="button" class="btn btn-succes mt-5">戻る</a>
        <button type="submit" class="btn btn-primary mt-5">更新</button>
   </div>


  </div>
</form>
    </div>
</div>

@endsection
@include('layouts.login.footer')
