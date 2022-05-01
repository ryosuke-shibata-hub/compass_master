<?php

namespace App\Http\Controllers\User\MyTask;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //

       public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('Task.index');
    }

    public function store(Request $request)
    {
        dd($request);
        return redirect()->back();
    }
}