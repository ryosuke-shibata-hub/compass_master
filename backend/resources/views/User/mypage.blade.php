@extends('layouts.login.common')
@section('title', 'マイページ')
@include('layouts.login.header')
@section('contents')

<a type="button" class="btn btn-info back_btn" href="{{ route('userPostIndex') }}">トップページへ</a>

    <p class="text-center">マイページ</p>
    <div class="edit_item">

    <div class="mypage_box">
            <li class="user_image pt-5">
                <img style="width:100px;" src="uploads/{{ Auth::user()->logo }}"></li>
            <li class="username pt-5">ユーザーネーム:{{ Auth::user()->username }}</li>
            <li class="email pt-5">登録メールアドレス:{{ Auth::user()->email }}</li>
            @if(Auth::user()->admin_role == 1)
                <li class="role pt-5">権限:管理者</li>
            @elseif(Auth::user()->admin_role == 10)
                <li class="role pt-5">権限:一般ユーザー</li>
            @else
                <li class="role pt-5">権限:てすと</li>
            @endif

            <li class="created_at pt-5">登録日:{{ Auth::user()->created_at }}</li>

            @if (Auth::user()->contributorAndAdmin($id))
        <a href="{{ route('mypage_edit',[$id]) }}">
        <i class="fas fa-user-edit"></i></a>
  @endif
    </div>
</div>

@endsection
@include('layouts.login.footer')
