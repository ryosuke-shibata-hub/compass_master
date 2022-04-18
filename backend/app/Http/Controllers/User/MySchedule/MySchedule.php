<?php

namespace App\Http\Controllers\User\MySchedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MySchedule extends Controller
{
    //
    public function index()
    {
        return view('MySchedule.top');
    }

}