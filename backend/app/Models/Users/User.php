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


    protected $fillable = [
        'username',
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
//認証
    public static function contributorAndAdmin($id) {
        return Auth::id() == $id || Auth::user()->admin_role == 1;
    }

    public static function profileUpdate($request,$profile_detail)
    {

        // dd($request);
    if($file = $request->logo) {
        $fileName = time().'.'.$file->getClientOriginalExtension();

        $target_path = public_path('uploads/');
        $file->move($target_path,$fileName);
    }else{
        $fileName = "";
    }
       $data['username'] = $request->username;
       $data['email'] = $request->email;
       $data['logo'] = $fileName;

        return $profile_detail->fill($data)->save();
    }
}