<?php

namespace App\Http\Controllers\User\MyTask;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //

    public function index()
    {
        return view('Task.index');
    }

    public function store(Request $request)
    {
        return redirect()->back();
    }
}