@section('header')
<header class="top_header">
<h1 class="header_top text-center pt-2 pb-2 fst-italic shadow-lg p-3 rounded font-monospace" style="background-color:#66cdaa;color:#ffffff;">Compass</h1>

<div class="login_user">
<ul class="dropdwn">
<li class="dropdown_bar">
  <i class="fas fa-power-off">
  {{ Auth::user()->username_kanji }}
  </i>
  <i class="fas fa-angle-down openbtn"></i>
  <ul class="drop_menu">
  <li>
  <a href="{{ route('logout') }}">LOGOUT</a>
  </li>
  <li>
  <p>
  <a href="{{ route('mypage') }}">My page</a>
  </p>
  </li>
  </ul>
</li>
</ul>
</div>



</header>
@endsection
