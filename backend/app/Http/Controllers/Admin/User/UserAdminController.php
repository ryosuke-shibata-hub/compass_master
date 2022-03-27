<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Carbon;
use App\Models\Users\User;
use App\Models\Users\CreateUserPersonChargesTable;
use App\Http\Requests\EditAdministratorPrivileges;
use App\Http\Requests\EditUserProfile;

class UserAdminController extends Controller
{
    //

    public function index() {
        return  view ('Admin.Administrator_management');
    }

    public function create()
    {

        $math_teacher = User::search_user_list()
        ->where('admin_role','=','5');
        $japanies_teacher = User::search_user_list()
        ->where('admin_role','=','0');

        return view ('Admin.Administrator_create_user')
        ->with('math_teacher',$math_teacher)
        ->with('japanies_teacher',$japanies_teacher);
    }
//管理者ユーザー登録
    public function store(EditAdministratorPrivileges $request) {

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

        $japanese_language_staff = $request->Japanese_language_staff_role;
        $math_language_staff = $request->math_language_staff_role;

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
        // dd($User->id);
        $User_teacher_staff = new CreateUserPersonChargesTable;
        $data_roll['user_id'] = $User->id;
        $data_roll['japanese_language_user_id'] = $japanese_language_staff;
        $data_roll['math_teacher_user_id'] = $math_language_staff;

        $User_teacher_staff->fill($data_roll)->save();

        return redirect()->route('Administrator');
    }
//管理者ユーザー情報編集
    public function addmin_user_edit() {

        return view('Admin.Administrator_show')
        ->with('user_list',User::Admin_user_list());
    }
    //ユーザー登録完了画面
    public function registerAdded() {
        return view('Auth.added');
    }
    public function edit(Request $request,$id) {

        $math_teacher = User::search_user_list()
        ->where('admin_role','=','5');
        $japanies_teacher = User::search_user_list()
        ->where('admin_role','=','0');

        $user = User::findOrFail($id);

        return view('Admin.Administrator_edit')
        ->with('user',$user)
        ->with('math_teacher',$math_teacher)
        ->with('japanies_teacher',$japanies_teacher);
    }
    public function update(Request $request,$id) {

    if($file = $request->logo) {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $target_path = public_path('uploads/');
        $file->move($target_path,$fileName);
    }else{
        $fileName = "user-regular-2.svg";
    }

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

        $japanese_language_staff = $request->Japanese_language_staff_role;
        $math_language_staff = $request->math_language_staff_role;

       $data = User::findOrFail($id);

       $data->username_kanji = $request->username_kanji;
       $data->username_kana = $request->username_kana;
       $data->email = $request->email;
       $data->logo = $fileName;
       $data->birthday = $birthday;
       $data->AdmissionDay = $AdmissionDay;
       $data->gender = $request->gender;
       $data->admin_role = $request->role;

       $data->save();

        return redirect()->route('Admin_user_show');
    }

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $user_id = User::findOrFail($id);
        $user_id->delete();

        return redirect()->route('Admin_user_show');
    }

    private function csv_colmns() {

        $csvlist = array(
            'id' =>'id',
            'username_kanji' => 'username_kanji',
            'username_kana' => 'username_kana',
            'birthday' => 'birthday',
            'AdmissionDay' => 'AdmissionDay',
            'gender' => 'gender',
            'email' => 'email',
            'password' => 'password',
            'admin_role' => 'admin_role',
            'logo' => 'logo',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'deleted_at' => 'deleted_at',
        );
        return $csvlist;
    }

    public function csv_download() {
        $csvlist = $this->csv_colmns();
        $filename = "auth_info_profile".date('Ymd').".csv";
        $stream = fopen('php://temp','r+b');
        $output = array();

        foreach ($csvlist as $key => $value) {
            $output[] = $value;
        }

        fputcsv($stream,$output);

        $blocksize = 100;
        for ($i=0; true; $i++) {
            $query  = \App\Models\Users\User::query();
            // $query->join('users','users.id','=','users.id');
            $query->orderBy('users.id');
            $query->skip($i * $blocksize);
            $query->take($blocksize);
            $lists = $query->get();

            if($lists->count() == 0) {
                break;
            }

            foreach ($lists as $lists) {
                $output = array();
                foreach ($csvlist as $key => $value) {
                    $output[] = str_replace(array("\r\n", "\r", "\n"),",",$lists->$key);
                }
                fputcsv($stream,$output);
            }
        }
        rewind($stream);

        $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));

        $csv = mb_convert_encoding($csv,'SJIS-win','UTF-8');

        $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            );
        return \Response::make($csv,200,$headers);
    }
}