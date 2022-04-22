<?php

namespace App\Http\Controllers\User\MySchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MySchedule\MyScheduleModel;
use log;

class MySchedule extends Controller
{
    //
    public function index()
    {
        return view('MySchedule.top');
    }

    public function store(Request $request)
    {

        Log::alert($request);

        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);

        $schedule = new MyScheduleModel;

        $schedule->start_date = date('Y-m-d',$request->input('start_date')/1000);
        $schedule->end_date = date('Y-m-d',$request->input('end_date')/1000);
        $schedule->event_name = $request->input('event_name');
        $schedule->save();

        return;
    }
}