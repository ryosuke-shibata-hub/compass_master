@extends('layouts.login.common')
@section('title','ユーザー一覧')
@include('layouts.login.header')
@section('contents')

    <div class="item_contents">
        <div class="nav_btn">
            <a href="#user_search" class="open_btn btn btn-success" type="buttom">検索</a>
        </div>
        <div class="item_box">
            <div class="all_user_list">
        @foreach($user_lists as $user_list)

                    <div class="user_item_box">
                        @if(!empty($user_list->logo))
                            <li class="user_img">
                                <img style="width:30px;" src="/uploads/{{ $user_list->logo }}">
                            </li>
                        @else
                            <li class="user_img">
                                <img style="width:30px;" src="/uploads/user-regular-2.svg">
                            </li>
                        @endif
                    <div class="user_main">
                        <li class="username">{{ $user_list->username_kanji }}</li>
                        <li class="user_age">年齢:{{ $user_list->birthday->age }}歳</li>
                    @if($user_list->gender == 1)
                        <li class="user_gender">女性</li>
                    @else
                        <li class="user_gender">男性</li>
                    @endif
                    </div>

                    <li class="birthday">誕生日:{{ $user_list->birthday->format('Y年m月d日') }}</li>
                    <li class="AdmissionDay">入学日:{{ $user_list->AdmissionDay->format('Y年m月d日') }}</li>
                    @foreach($user_list->japanese_language as $japanese_language)
                        <li class="japanese_language">国語担当教師:{{ $japanese_language->username_kanji }}</li>
                    @endforeach
                    @foreach($user_list->math_teacher as $math_teacher)
                        <li class="math_teacher">数学教師:
                            {{ $math_teacher->username_kanji }}</li>
                    @endforeach
                    @foreach($user_list->userScore as $score)
                       <li class="userScore">点数:{{ $score->score }}点</li>
                    @endforeach

                    @if($user_list->admin_role == 0)
                        <li class="role">権限:国語教師</li>
                    @elseif($user_list->admin_role == 5)
                        <li class="role">権限:数学教師</li>
                    @elseif($user_list->admin_role == 10)
                        <li class="role">権限:生徒</li>
                    @elseif($user_list->admin_role == 15)
                        <li class="role">権限:管理者</li>
                    @endif
                </div>

        @endforeach
        </div>
        </div>

    </div>
                <li class="page-item" style="margin-left: 870px;">
                    {{ $user_lists->links() }}
                </li>
@endsection
@include('layouts.login.footer')
