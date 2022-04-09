<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class QuestionComment extends Model
{
    //
    protected $table = 'question_comments';
    protected $dates = [
        'event_at',
        'updated_at',
        'created_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'question_box_id',
        'delete_user_id',
        'update_user_id',
        'question_comment',
        'event_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
       return $this->belongsTo('App\Models\Users\User','user_id');
    }

    public function question_comment_reply()
    {
        return $this->hasMany('App\Models\Posts\QuestionCommentReplies','question_comment_id');
    }
    public static function questionQuery()
    {
        return self::with([
            'user',
        ]);
    }

    public static function questionCommentDetail($id)
    {
        return self::questionQuery()->findOrFail($id);
    }

    public static function question_comment_store($request,$id)
    {
        // dd($id);
        $comment = new QuestionComment();
        $data['question_box_id'] = $id;
        $data['question_comment'] = $request->name;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $data['created_at'] = carbon::now();
        $data['updated_at'] = carbon::now();

        $comment->fill($data)->save();
    }
}