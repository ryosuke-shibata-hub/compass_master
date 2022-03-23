<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class CommentReplies extends Model
{

    protected $table = 'comment_replies_table';

    protected $dates = [
       'event_at',
    ];

    protected $fillable = [
        'user_id',
        'comment_id',
        'delete_user_id',
        'update_user_id',
        'comment_replies',
    ];

    public function user(){

        return $this->belongsTo('App\Models\Users\User');
    }

    public function postComments() {
        return $this->belongsTo('App\Models\Posts\PostComment');
    }
    public static function commentQuery() {

        return self::with([
            'user',
        ]);

    }

    public static function commentDetail() {
        return self::commentQuery()->get();
    }
}