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
        'question_id',
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
       return $this->belongsTo('App\Models\Users\User');
    }

    public function question_comments()
    {
        return $this->hasMany('App\Models\Posts\QuestionCommentReplies','question_comment_id');
    }

    public static function questionCommentQuery()
    {
        return self::with([
            'user',
            'question_comments',
        ]);
    }

    public static function questionCommentDetail($id)
    {
        return self::questionCommentQuery()->findOrFail($id);
    }
    public static function question_comment_store($request,$id)
    {
        $comment = new QuestionComment();
        $data['question_id'] = $id;
        $data['question_comment'] = $request->name;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $data['created_at'] = carbon::now();
        $data['updated_at'] = carbon::now();

        $comment->fill($data)->save();
    }
}