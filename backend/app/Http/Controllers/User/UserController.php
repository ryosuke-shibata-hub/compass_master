<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use Auth;

class UserController extends Controller
{
    //

    public function index()
    {
        $id = Auth::user()->id;
        return view('User.mypage')
        ->with('id',$id);
    }

    public function edit() {
        return view('User.mypage_edit');
    }

    public function update(Request $request) {

        $profile_detail = Auth::user();

        if (User::contributorAndAdmin($profile_detail->id)) {
            $profile_detail->profileUpdate($request, $profile_detail);
            return redirect()->route('mypage');
        }
        return \App::abort(403,'unauthorized action.');
    }

}