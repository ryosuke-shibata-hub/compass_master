@extends('layouts.login.common')
@section('title','スクール予約')
@include('layouts.login.header')
@section('contents')
<!-- resources/views/calendar.blade.php -->
<div class="calender-contents">
    <div class="SchoolCalender">
        <div class="col-md-6 w-50">
            <a href="{{ route('calendar', ['year' => $mv_now_year, 'month' => $mv_now_month]) }}" class="btn btn-outline-info">当月へ</a>
        </div>
        <div class="row calender-nav">
            <div class="col-md-6 w-25">
                <a href="{{ route('calendar', ['year' => $firstDayOfMonth->copy()->subMonth()->year, 'month' => $firstDayOfMonth->copy()->subMonth()->month]) }}" class="btn btn-outline-primary">前月</a>
            </div>
            <div class="col-md-6 w-50">
                <p class="calender-now-display">{{ $firstDayOfMonth->format('Y年m月') }}</p>
            </div>
            <div class="col-md-6 w-25">
                <a href="{{ route('calendar', ['year' => $firstDayOfMonth->copy()->addMonth()->year, 'month' => $firstDayOfMonth->copy()->addMonth()->month]) }}"class="btn btn-outline-success">次月</a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr class="calender-weeks-head">
                @foreach($weeks as $i => $week)
                    <th @if($i===\Carbon\Carbon::SUNDAY) class="text-red"
                        @elseif($i===\Carbon\Carbon::SATURDAY) class="text-blue" @endif>
                        {{ $week }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <form action="{{ route('store_school_reservation') }}" method="POST">
                @csrf
            <tbody>
            @foreach($dates as $date)
            @if($date < now())
                @if($date->isSunday())
                    <tr>
                        @endif
                        <td class="calender_td_width" style="background-color: #c0c0c0">{{ $date->format('j') }}日
                            <input type="hidden" name="reserved_day" value="{{ $date->format('j') }}">
                        </td>
                        @if($date->isSaturday())
                    </tr>
                @endif
            @else
                @if($date->isSunday())
                    <tr>
                        @endif
                        <td class="calender_td_width" style="background-color: #ffffff">{{ $date->format('j') }}日
                            <br>
                                <select class="form-select form-select-sm w-75" name="select_room">
                                    <option></option>
                                    @foreach($room_list as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                    @endforeach
                            </select>
                        </td>
                        @if($date->isSaturday())
                    </tr>
                @endif
            @endif
            @endforeach
            </tbody>
        </table>
        <div class="btn-position">
                <button class="btn btn-outline-info" type="submit">
                    予約する
                </button>
                <input type="hidden" name="year" value="{{ $mv_now_year }}">
                <input type="hidden" name="month" value="{{ $mv_now_month }}">
                {{-- <input type="hidden" name="year" value="{{  }}"> --}}
        </div>
        </form>
    </div>
</div>


@endsection
@include('layouts.login.footer')
