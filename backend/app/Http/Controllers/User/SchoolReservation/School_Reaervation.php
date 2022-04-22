<?php

namespace App\Http\Controllers\User\SchoolReservation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class School_Reaervation extends Controller
{

    public function index(int $year = null,int $month = null)
    {
        $weeks = ['日','月','火','水','木','金','土'];
        $carbon = new Carbon();
        $carbon->locale('ja_JP');

        if($year) {
            $carbon->setYear($year);
        }
        if($month) {
            $carbon->setMonth($month);
        }

        $carbon->setDay(1);
        $carbon->setTime(0,0);

        $firstDayOfMonth = $carbon->copy()->firstOfMonth();
        $lastOfMonth = $carbon->copy()->lastOfMonth();

        $firstDayOfCalender = $firstDayOfMonth->copy()->startOfWeek();
        $endDayOfCalender = $lastOfMonth->copy()->endOfWeek();

        $dates = [];
        while ($firstDayOfCalender < $endDayOfCalender) {
            $dates[] = $firstDayOfCalender->copy();
            $firstDayOfCalender->addDay();
        }
// dd($firstDayOfMonth);
        return view('SchoolReservation.index')
        ->with('weeks',$weeks)
        ->with('dates',$dates)
        ->with('firstDayOfMonth',$firstDayOfMonth);
    }

    public function store(Request $request)
    {
        // dd($request);

        return redirect()->back();
    }

}