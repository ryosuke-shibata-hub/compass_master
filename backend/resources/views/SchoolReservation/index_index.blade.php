{{-- @extends('layouts.login.common')
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
            <tbody>
            @foreach($dates as $date)
            @if($date < now())
                @if($date->isSunday())
                    <tr>
                        @endif
                        <td class="calender_td_width" style="background-color: #c0c0c0">{{ $date->format('j') }}日
                        </td>
                        @if($date->isSaturday())
                    </tr>
                @endif
            @else
                @if($date->isSunday())
                    <tr>
                        @endif
                            <td class="calender_td_width" style="background-color: #ffffff" >{{ $date->format('j') }}日
                                <select form="school_reservation" class="form-select form-select-sm w-75" name="select_room">
                                    <option value="0"></option>
                                    <option value="1">リモ1部</option>
                                    <option value="2">リモ2部</option>
                                    <option value="3">リモ3部</option>
                                    <option value="4">本社1部</option>
                                    <option value="5">本社2部</option>
                                    <option value="6">本社3部</option>
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
            <form id="school_reservation" action="{{ route('store_school_reservation') }}" method="POST">
                @csrf
                    <button class="btn btn-outline-info" type="submit" onclick="return checkSubmit('予約しますか？');">
                        予約する
                        <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
                    </button>
            </form>
        </div>

    </div>
</div>


@endsection
@include('layouts.login.footer') --}}
