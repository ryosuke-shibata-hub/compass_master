@extends('layouts.login.common')
@section('title','ユーザー一覧')
@include('layouts.login.header')
@section('contents')

    <div class="item_contents">
        <div class="nav_btn">
            <a href="#search" class="open-btn btn btn-success" type="buttom">検索</a>
            <a type="btn" class="btn btn-danger reset_btn" href="{{ route('all_user_list') }}">リセット</a>
        </div>

        <div class="modal_window">
                <p class="text-center pt-5">詳細検索</p>
                <a class="close_button">
                    <i class="fas fa-times-circle"></i>
                </a>
                <form action="{{ route('all_user_list') }}" method="get">
                    <div class="form-group">
                        <label class="search_title">フリーワード検索:</label>
                        <div class="search_box">
                            <input type="text" class="search_box" name="freeword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="search_title">並び替え:</label>
                        <div class="search_box">
                            <label>名前:</label>
                            <select name="name_sort_desc">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="search_title">年齢:</label>
                        <div class="search_box">
                            <label>From</label>
                                <select class="from_age" name="from_age">
                                    <option>------</option>
                                        @for($i = 15; $i <= 65; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                </select>
                            <label>〜</label>
                            <label>TO</label>
                                <select name="to_age" class="to_age">
                                    <option>------</option>
                                        @for($i = 15; $i <= 65; $i++)
                                            <option>{{ $i }}</option>
                                        @endfor
                                </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="search_title">入学日:</label>
                        <div class="search_box">
                            <label>From</label>
                            <input type="text" id="from_datepicker" class="input_button" name="from_admission">
                            <label>〜</label>
                            <label>TO</label>
                            <input type="text" id="to_datepicker" class="input_button" name="to_admission">
                            {{-- <input type="date" id="from_datepicker" class="input_button" name="from_admission">
                            <label>〜</label>
                            <label>TO</label>
                            <input type="date" id="to_datepicker" class="input_button" name="to_admission"> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="search_title">担当数学教師:</label>
                        @foreach($user_lists as $math_teacher)
                        <div class="search_box">
                            @if($math_teacher->admin_role == 5)
                                <label>{{ $math_teacher->username_kanji }}</label>
                                <input type="checkbox" class="input_button" name="math_teacher" value="">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label class="search_title">担当国語教師:</label>
                        @foreach($user_lists as $japanese_language_teacher)
                        <div class="search_box">
                            @if($japanese_language_teacher->admin_role == 7)
                                 <label>{{ $japanese_language_teacher->username_kanji }}</label>
                                <input type="checkbox" class="input_button" name="japanese_language" value="">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label class="search_title">点数:</label>
                        <div class="search_box">
                            <label>From</label>
                            <select name="from_score" class="from_score">
                                <option>------</option>
                                @for($i = 0; $i <= 500; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                            <label>〜</label>
                            <label>TO</label>
                            <select name="to_score" class="to_score">
                                <option>------</option>
                                @for($i = 0; $i <= 500; $i++)
                                    <option>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="search_title">権限:</label>
                        <div class="search_box">
                            <label>生徒</label>
                            <input type="checkbox" class="input_button" name="role" value="10">
                            <label>国語教師</label>
                            <input type="checkbox" class="input_button" name="role" value="7">
                            <label>数学教師</label>
                            <input type="checkbox" class="input_button" name="role" value="5">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary user_search_btn">
                        検索
                    </button>
                </form>
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

                    @if($user_list->admin_role == 7)
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
