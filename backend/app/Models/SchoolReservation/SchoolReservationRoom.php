<?php

namespace App\Models\SchoolReservation;

use Illuminate\Database\Eloquent\Model;

class SchoolReservationRoom extends Model
{
    //
    protected $table = 'school_reservation_room';

    protected $dates = [
        'event_at',
    ];

    protected $fillable = [
        'room_name',
        'room_flg',
        'number_of_free_selects',
        'created_at',
    ];
}