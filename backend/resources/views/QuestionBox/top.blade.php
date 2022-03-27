@extends('layouts.login.common')
@section('title', '質問箱')
@include('layouts.login.header')
@section('contents')
<div class="home_index_page">
    <?php
        dd($question_lists);
        ?>
</div>

@endsection
@include('layouts.login.footer')
