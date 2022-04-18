<?php

namespace App\Http\Controllers\User\SchoolReservation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class School_Reaervation extends Controller
{
    //
    public function index(Request $request, $month)
    {
        $calendar = calendar($section, $patient, $month);
        $month = new CarbonImmutable($month);


        return view('SchoolReservation.top')
        ->with('month',$month)
        ->with('calendar',$calendar);
    }
}