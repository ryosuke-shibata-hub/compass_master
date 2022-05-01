<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Auth;
use Log;


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

    public function CommentsReplies() {
        return $this->hasMany('App\Models\Posts\CommentReplies');
    }

    public function userScore() {
        return  $this->hasMany('App\Models\Users\CreateUserScoresTable');
    }

    public function math_teacher() {

        return $this->hasMany('App\Models\Users\CreateUserPersonChargesTable')
        ->join('users','user_person_charges.math_teacher_user_id',"=",'users.id');
    }

    public function japanese_language() {

        return $this->hasMany('App\Models\Users\CreateUserPersonChargesTable')
        ->join('users','user_person_charges.japanese_language_user_id',"=",'users.id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public static function UserQuery() {
        return self::with([
            'userScore',
            'math_teacher',
            'japanese_language',
        ]);
    }

//検索項目
    public static function search_user_list()
    {
        return self::UserQuery()->get();
    }
//管理者用ユーザーリスト
     public static function Admin_user_list()
    {
        return self::UserQuery()->paginate(20);
    }

//検索画面
    public static function userList($request) {


        if(($request->reset_btn) && ($request->is_null)){

        $all_user_list = self::UserQuery()
        ->orderBy('created_at','desc');

        return $all_user_list->paginate(10);

        }elseif (!empty($request) && !is_null($request)) {
        $all_user_list = self::UserQuery();


        $sort_parents = $request->sort_parents;
        $sort_children = $request->sort_children;
        $search_word = $request->freeword;
        $role = $request->role;
        $from_admission = $request->from_admission;
        $to_admission = $request->to_admission;
        $math_teacher_in_charge = $request->math_teacher;
        $language_teacher_in_charge = $request->japanese_language;
        $from_score = $request->from_score;
        $to_score = $request->to_score;
        $age = $request->only([
            'from_age',
            'to_age',
        ]);

        if (($sort_parents == '0' && ($sort_children == '0'))) {
            $all_user_list = $all_user_list
            ->orderBy('username_kanji','desc');
        }
        if (($sort_parents == '0' && ($sort_children == '1'))) {
            $all_user_list = $all_user_list
            ->orderBy('username_kanji','asc');
        }
        if (($sort_parents == '1' && ($sort_children == '0'))) {
            $all_user_list = $all_user_list
            ->orderBy('birthday','desc');
        }
        if (($sort_parents == '1' && ($sort_children == '1'))) {
            $all_user_list = $all_user_list
            ->orderBy('birthday','asc');
        }
        if (($sort_parents == '2' && ($sort_children == '0'))) {
            $all_user_list = $all_user_list
            ->orderBy('AdmissionDay','desc');
        }
        if (($sort_parents == '2' && ($sort_children == '1'))) {
            $all_user_list = $all_user_list
            ->orderBy('AdmissionDay','asc');
        }
        if (($sort_parents == '3' && ($sort_children == '0'))) {
            $all_user_list = User::select('users.*')
            ->leftjoin('user_scores','users.id','=','user_scores.user_id')
            ->orderBy('user_scores.score','desc');
        }
        if (($sort_parents == '3' && ($sort_children == '1'))) {
            $all_user_list = User::select('users.*')
            ->leftjoin('user_scores','users.id','=','user_scores.user_id')
            ->orderBy('user_scores.score','asc');
        }



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
        if ($math_teacher_in_charge) {
            $all_user_list = $all_user_list
            ->orwhereIn('id',function($query)use($math_teacher_in_charge) {
                $query->from('user_person_charges')
                ->select('user_id')
                ->where('math_teacher_user_id',$math_teacher_in_charge);
            });
        }

        if($language_teacher_in_charge) {
            $all_user_list = $all_user_list
            ->orwhereIn('id',function($query)use($language_teacher_in_charge) {
                $query->from('user_person_charges')
                ->select('user_id')
                ->where('japanese_language_user_id',$language_teacher_in_charge);
            });
        }
        if (!empty($from_score) && $from_score != '------') {
            $all_user_list = $all_user_list
            ->orwhereIn('id',function($query)use($from_score) {
                $query->from('user_scores')
                ->select('user_id')
                ->where('score','>=',$from_score);
            });
        }

        if (!empty($to_score) && $to_score != '------') {
            $all_user_list = $all_user_list
            ->orwhereIn('id',function($query)use($to_score) {
                $query->from('user_scores')
                ->select('user_id')
                ->where('score','<=',$to_score);
            });
        }
       if(!empty($age)) {
            if(!empty($age['from_age']) && $age['from_age'] != '------') {
                $from_age = Carbon::now()->subyear($age['from_age'])->format('Y-m-d');
                $all_user_list = $all_user_list
                ->where('birthday','<=',$from_age);
            }
            if(!empty($age['to_age']) && $age['to_age'] != '------') {
                 $to_age = Carbon::now()->subyear($age['to_age'])->format('Y-m-d');
                $all_user_list = $all_user_list
                ->where('birthday','>=',$to_age);
            }
       }

        return $all_user_list->paginate(10);
    }

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

    // public static function profileUpdateAdmin($request,$id)
    // {
    //     if($file = $request->logo) {
    //     $fileName = time().'.'.$file->getClientOriginalExtension();
    //     $target_path = public_path('uploads/');
    //     $file->move($target_path,$fileName);
    // }else{
    //     $fileName = "user-regular-2.svg";
    // }

    //     $birthday_year = $request->birthday_year;
    //     $birthday_month = $request->birthday_month;
    //     $birthday_day = $request->birthday_day;
    //     $birthday = $birthday_year.$birthday_month.$birthday_day;
    //     $birthday = Carbon::parse($birthday)->format('Y-m-d');

    //     $Admission_year = $request->Admission_year;
    //     $Admission_month = $request->Admission_month;
    //     $Admission_day = $request->Admission_day;
    //     $AdmissionDay = $Admission_year.$Admission_month.$Admission_day;
    //     $AdmissionDay = Carbon::parse($AdmissionDay)->format('Y-m-d');

    //     $japanese_language_staff = $request->Japanese_language_staff_role;
    //     $math_language_staff = $request->math_language_staff_role;

    //    $data['firstname_kanji'] = $request->username_kanji;
    //    $data['firstname_kana'] = $request->username_kana;
    //    $data['email'] = $request->email;
    //    $data['logo'] = $fileName;
    //    $data['birthday'] = $birthday;
    //    $data['AdmissionDay'] = $AdmissionDay;
    //    $data['gender'] = $request->gender;

    //     return $profile_detail->fill($data)->save();
    // }
}