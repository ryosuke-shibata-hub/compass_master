@extends('layouts.login.common')
@section('title','スクール予約')
@include('layouts.login.header')
@section('contents')
<!-- resources/views/calendar.blade.php -->
<div class="home_index_page">
    <div class="home_layouts">
        <div class="calender-contents">
            <div class="SchoolCalender">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                                <form action="{{ route('Calendar_top') }}" method="POST">
                                    @csrf
                                        <div class="card-header">{{ $calendar->getTitle() }}</div>
                                        <div class="card-body">
                                                {!! $calendar->render() !!}
                                        </div>
                                        <input type="hidden" name="1" value="1">
                                        <button type="submit" class="btn btn-outline-primary">予約する</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@include('layouts.login.footer')
