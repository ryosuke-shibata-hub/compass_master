@extends('layouts.login.common')
@section('title','マイスケジュール')
@include('layouts.login.header')
@section('contents')

<div class="school_reservation_content">
            <div id="app">
            <div class="m-auto w-50 m-5 p-5">
                <div id='calendar'></div>
            </div>
        </div>

        <link href='{{ asset('fullcalendar-5/lib/main.css') }}' rel='stylesheet'>
        <script src='{{ asset('fullcalendar-5/lib/main.js') }}'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'ja',
                    height: 'auto',
                    firstDay: 1,
                    headerToolbar: {
                        left: "dayGridMonth,listMonth",
                        center: "title",
                        right: "today prev,next"
                    },
                    buttonText: {
                        today: "今月",
                        month: "月",
                        list: "リスト"
                    },
                    noEventsContent: "スケジュールはありません",
                });
                calendar.render();
            });
        </script>
        <div class="reservation_btn">
            <button class="btn btn-primary" type="submit">予約する</button>
        </div>
</div>
@endsection
@include('layouts.login.footer')
