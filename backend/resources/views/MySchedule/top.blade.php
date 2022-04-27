@extends('layouts.login.common')
@section('title','マイスケジュール')
@include('layouts.login.header')
@section('contents')
<script src="{{ mix('js/app.js') }}"></script>
{{-- <script src="{{ asset('js/ja.js') }}" defer></script> --}}
<div class="school_reservation_content">
            <div id="calender">
                <div class="m-auto w-50 m-5 p-5">
                    <div id='calendar'></div>
                </div>
            </div>
</div>
@endsection
@include('layouts.login.footer')
