<?php

namespace App\Models\MySchedule;

use Illuminate\Database\Eloquent\Model;

class MyScheduleModel extends Model
{
    //
    protected $table = 'my_scedules';

    protected $fillable = [
        'start_date',
        'end_date',
        'event_name',
        'user_id',
    ];
}