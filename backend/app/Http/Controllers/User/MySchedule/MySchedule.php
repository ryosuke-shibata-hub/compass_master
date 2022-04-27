<?php

namespace App\Http\Controllers\User\MySchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MySchedule\MyScheduleModel;
use Log;
use Auth;

class MySchedule extends Controller
{
    //
    public function index(Request $request)
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
        $user_id = Auth::user()->id;

        $schedule = new MyScheduleModel;

        $schedule->start_date = date('Y-m-d',$request->input('start_date')/1000);
        $schedule->end_date = date('Y-m-d',$request->input('end_date')/1000);
        $schedule->event_name = $request->input('title');
        $schedule->user_id = $user_id;
        $schedule->save();

        return;
    }
}