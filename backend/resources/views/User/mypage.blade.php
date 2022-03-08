@extends('layouts.login.common')
@section('title', 'マイページ')
@include('layouts.login.header')
@section('contents')

<a type="button" class="btn btn-info back_btn" href="{{ route('userPostIndex') }}">トップページへ</a>

    <p class="text-center">マイページ</p>
    <div class="edit_item">

    <div class="mypage_box">
        @if(!empty(Auth::user()->logo))
            <li class="user_image pt-5">
                <img style="width:100px;" src="uploads/{{ Auth::user()->logo }}">
            </li>
        @else
            <li class="user_image pt-5">
                <img style="width:100px;" src="uploads/user-regular-2.svg">
            </li>
        @endif

            <li class="username pt-5">ユーザーネーム:{{ Auth::user()->username_kanji }}</li>
            <li class="email pt-5">登録メールアドレス:{{ Auth::user()->email }}</li>
            @if(Auth::user()->admin_role == 15)
                <li class="role pt-5">権限:管理者</li>
            @elseif(Auth::user()->admin_role == 10)
                <li class="role pt-5">権限:生徒</li>
            @elseif(Auth::user()->admin_role == 5)
                <li class="role pt-5">権限:数学教師</li>
            @elseif(Auth::user()->admin_role == 0)
                <li class="role pt-5">権限:国語教師</li>
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
