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

    public function get_calendar(Request $request)
    {
         $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // カレンダー表示期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);
        $user_id = Auth::user()->id;
        // 登録処理
        return MyScheduleModel::query()
            ->select(
                // FullCalendarの形式に合わせる
                'start_date as start',
                'end_date as end',
                'event_name as title'
            )
            // FullCalendarの表示範囲のみ表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date)
            ->where('user_id',$user_id)
            ->get();
    }


    public function store(Request $request)
    {

        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
            'event_name' => 'required|max:32',
        ]);
        $user_id = Auth::user()->id;

        $schedule = new MyScheduleModel;

        $schedule->start_date = date('Y-m-d',$request->input('start_date')/1000);
        $schedule->end_date = date('Y-m-d',$request->input('end_date')/1000);
        $schedule->event_name = $request->input('event_name');
        $schedule->user_id = $user_id;
        $schedule->save();

        return;
    }
}