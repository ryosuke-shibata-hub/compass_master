<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

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

    public static function question_comment_replies_store($request,$id)
    {
        // dd($id);
        $reply = new QuestionCommentReplies();
        $data['question_comment_id'] = $id;
        $data['comment_replies'] = $request->question_reply;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $data['created_at'] = carbon::now();
        $data['updated_at'] = carbon::now();

        $reply->fill($data)->save();
    }
}