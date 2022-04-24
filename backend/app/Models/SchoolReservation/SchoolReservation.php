<?php

namespace App\Models\SchoolReservation;

use Illuminate\Database\Eloquent\Model;

class SchoolReservation extends Model
{
    //
    protected $table = 'school_reservation';

    protected $dates = [
        'event_at',
        'create_at',
    ];

    protected $fillable = [
        'user_id',
        'reserved_room_id',
        'event_at',
        'created_at',
    ];
}