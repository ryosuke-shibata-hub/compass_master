@extends('layouts.login.common')
@section('title','マイスケジュール')
@include('layouts.login.header')
@section('contents')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Script -->
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{ asset('fullcalendar-5/lib/main.css') }}" rel='stylesheet'>
        <script src="{{ asset('fullcalendar-5/lib/main.js') }}"></script>
        <script src="{{ asset('js/calendar.js') }}" defer></script>


<div class="school_reservation_content">
            <div id="calender">
                <div class="m-auto w-50 m-5 p-5">
                    <div id='calendar'></div>
                </div>
            </div>


</div>
@endsection
@include('layouts.login.footer')
