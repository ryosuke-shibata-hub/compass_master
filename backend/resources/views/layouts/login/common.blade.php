<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/login/login.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login/user_post.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login/Administrator.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login/user_list.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/login/modal.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/UI-darkness/jquery-ui.css">
    <script src="/js/datepicker-ja.js"></script>
  <title>@yield('title')</title>
</head>
<body>

 @yield('header')
        <div class="collapes navbar-collapes" id="app-navbar-collapse">
            <div class="openbtn-side"><span></span><span></span><span></span></div>
                <nav id="g-nav">
                <div id="nav-bar-right">
            <ul class="nav navbar-nav navbar-left">
                    <li class="top_page pt-5 nav_list">
                        <a href="/top">トップページ</a>
                    </li>
                    <li class="user_list pt-5 nav_list">
                        <a href="/user/all_user_list">ユーザー一覧</a>
                    </li>
                    <li class="user_list pt-5 nav_list">
                        <a href="/post/index">投稿一覧</a>
                    </li>
                    <li class="user_list pt-5 nav_list">
                        <a href="/post/index">質問</a>
                    </li>
                    @can('admin')
                    <li class="user_list pt-5 nav_list">
                        <a href="/admin/index">管理者ページ</a>
                    </li>
                    @endcan
            </ul>
            </div>
            </nav>
            </div>
     @yield('contents')

   </div>
  </div>
    @yield('footer')
    @yield('btn-dell')

</body>
</html>
