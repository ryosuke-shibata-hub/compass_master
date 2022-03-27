<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class CommentReplies extends Model
{

    protected $table = 'comment_replies_table';

    protected $dates = [
       'event_at',
       'updated_at',
       'created_at',
       'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'comment_id',
        'delete_user_id',
        'update_user_id',
        'comment_replies',
        'event_at',
    ];

    public function user(){

        return $this->belongsTo('App\Models\Users\User');
    }

    public function postComments() {
        return $this->belongsTo('App\Models\Posts\PostComment');
    }

    public static function create_replies($request,$id) {

        $replies = new CommentReplies();

        $data['user_id'] = Auth::user()->id;
        $data['comment_id'] = $id;
        $data['comment_replies'] = $request->comment_replies;
        $data['event_at'] = carbon::now();

        $replies->fill($data)->save();

    }
}