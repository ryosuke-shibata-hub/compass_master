<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class QuestionCommentReplies extends Model
{
    //
    protected $table = 'question_comment_replies';
    protected $dates = [
       'event_at',
       'updated_at',
       'created_at',
       'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'question_comment_id',
        'delete_user_id',
        'update_user_id',
        'comment_replies',
        'event_at',
    ];

    public function user(){

        return $this->belongsTo('App\Models\Users\User');
    }

    public function questionComments()
    {
        return $this->hasMany('App\Models\Posts\QuestionComment');
    }

    // public static function questionCommentDetail() {
    //     return self::with([
    //         'questionComments',
    //         'user',
    //     ]);
    // }

    // public static function questionCommentQuery($id)
    // {
    //     return self::questionCommentDetail()->findOrFail($id);
    // }
}