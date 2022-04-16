@extends('layouts.login.common')
@section('title','チャット')
@include('layouts.login.header')
@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        </div>
    </div>

    {{--  チャット可能ユーザ一覧  --}}
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
        <tr>
            <th>{{$loop->iteration}}</th>
            <td>{{$user->username_kanji}}</td>
            <td><a href="/chat/{{$user->id}}"><button type="button" class="btn btn-primary">ちゃっとする</button></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
@include('layouts.login.footer')
