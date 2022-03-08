<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Carbon;
use App\Models\Users\User;

class UserAdminController extends Controller
{
    //

    public function index() {
        return  view ('Admin.Administrator_management');
    }

    public function create()
    {
        return view ('Admin.Administrator_create_user');
    }

    public function store(Request $request) {

        // dd($request);
        $birthday_year = $request->birthday_year;
        $birthday_month = $request->birthday_month;
        $birthday_day = $request->birthday_day;
        $birthday = $birthday_year.$birthday_month.$birthday_day;
        $birthday = Carbon::parse($birthday)->format('Y-m-d');

        $Admission_year = $request->Admission_year;
        $Admission_month = $request->Admission_month;
        $Admission_day = $request->Admission_day;
        $AdmissionDay = $Admission_year.$Admission_month.$Admission_day;
        $AdmissionDay = Carbon::parse($AdmissionDay)->format('Y-m-d');

        $firstname_kanji = $request->firstname_kanji;
        $lastname_kanji = $request->lastname_kanji;
        $username_kanji = $firstname_kanji.$lastname_kanji;

        // dd($username_kanji);
        $firstname_kana = $request->firstname_kana;
        $lastname_kana = $request->lastname_kana;
        $username_kana = $firstname_kana.$lastname_kana;

        $User = new User;

        $data['username_kanji'] = $username_kanji;
        $data['username_kana'] = $username_kana;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['birthday'] = $birthday;
        $data['AdmissionDay'] = $AdmissionDay;
        $data['gender'] = $request->gender;
        $data['admin_role'] = $request->role;

        $User->fill($data)->save();

        return redirect()->route('Administrator');
    }

    //ユーザー登録完了画面
    public function registerAdded() {
        return view('Auth.added');
    }
}