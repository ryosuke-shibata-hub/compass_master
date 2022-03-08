<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        // return $this->belongsToMany('App\Models\Posts\PostComment','post_comment_favorites',
        // 'user_id','post_comment_id');
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

    public static function userList() {
        return self::UserQuery()->paginate(4);
    }
//認証
    public static function contributorAndAdmin($id) {
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }

    // public static function userList()
    // {
    //     // $userList = User::orderBy('created_at','desc');
    //     $user_list = self::userScore()
    //     ->orderBy('created_at','desc');

    //     return $userList->paginate(4);
    // }

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