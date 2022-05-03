<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use Carbon;
use App\Http\Controllers\Controller;
use App\Calendar\CalendarView;

class CalendarController extends Controller
{
    //

    public function show()
    {
        $calendar = new CalendarView(time());

        return view('SchoolReservation.index_index')
        ->with('calendar',$calendar);
    }
}