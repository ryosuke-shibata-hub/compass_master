@extends('layouts.login.common')
@section('title','スクール予約')
@include('layouts.login.header')
@section('contents')
<!-- resources/views/calendar.blade.php -->
<div class="calender-contents">
  <div class="SchoolCalender">
      <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ $calendar->getTitle() }}</div>
               <div class="card-body">
					{!! $calendar->render() !!}
               </div>
           </div>
       </div>
   </div>
  </div>
</div>


@endsection
@include('layouts.login.footer')
