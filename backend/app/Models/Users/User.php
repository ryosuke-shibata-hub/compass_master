<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Auth;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $dates = [
        'birthday',
        'AdmissionDay',
    ];

    protected $fillable = [
        'username_kanji',
        'username_kana',
        'birthday',
        'AdmissionDay',
        'gender',
        'email',
        'password',
        'admin_role',
        'logo',
    ];

    public function userCommentFavoriteRelation()
    {
        return $this->hasMany(PostComment::Class);
    }

    public function userScore() {
        return  $this->hasMany('App\Models\Users\CreateUserScoresTable','user_id');
    }

    public function math_teacher() {

        return $this->hasMany('App\Models\Users\CreateUserPersonChargesTable')
        ->join('users','user_person_charges.math_teacher_user_id',"=",'users.id');
    }

    public function japanese_language() {

        return $this->hasMany('App\Models\Users\CreateUserPersonChargesTable')
        ->join('users','user_person_charges.japanese_language_user_id',"=",'users.id');
    }

    public static function UserQuery() {
        return self::with([
            'userScore',
            'math_teacher',
            'japanese_language',
        ]);
    }

    public static function  userListReset() {
        return self::UserQuery()->get();
    }

    public static function userList($request) {

        // dd($request);
        if($request->reset_btn) {

        $all_user_list = self::UserQuery()
        ->orderBy('created_at','desc');

        return $all_user_list->paginate(10);
        }

        $all_user_list = self::UserQuery()
        ->orderBy('created_at','desc');
        $search_word = $request->freeword;
        $role = $request->role;
        $from_admission = $request->from_admission;
        $to_admission = $request->to_admission;
        $from_age = $request->from_age;
        $to_age = $request->to_age;
        $from_score = $request->from_score;
        $to_score = $request->to_score;

        if ($search_word) {
            $all_user_list = $all_user_list
            ->where('users.username_kanji','like','%'.$search_word.'%');
        }
        if ($role) {
            $all_user_list = $all_user_list
            ->where('admin_role',$role);
        }
        if ($from_admission) {
            $all_user_list = $all_user_list
            ->where('AdmissionDay','>=',$from_admission);
        }
        if ($to_admission){

            $all_user_list = $all_user_list
            ->where('AdmissionDay','<=',$to_admission);
        }

        return $all_user_list->paginate(10);

    }
//認証
    public static function contributorAndAdmin($id) {
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }

    public static function profileUpdate($request,$profile_detail)
    {


    if($file = $request->logo) {
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $target_path = public_path('uploads/');
        $file->move($target_path,$fileName);
    }else{
        $fileName = "user-regular-2.svg";
    }

       $data['username'] = $request->username;
       $data['email'] = $request->email;
       $data['logo'] = $fileName;
       $data['password'] = bcrypt($request->password);;

        return $profile_detail->fill($data)->save();
    }
}