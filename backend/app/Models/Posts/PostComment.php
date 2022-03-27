<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use Log;

class PostComment extends Model
{
    protected $table = 'post_comments';

      protected $dates = [
       'event_at',
    ];

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    //Userとのリレーション
    public function user() {
        return $this->belongsTo('App\Models\Users\User','user_id');
    }

    public function commentFavorite() {
        return $this->hasMany(PostCommentFavorite::Class);
    }

    public function CommentsReplies() {
        return $this->hasMany('App\Models\Posts\CommentReplies','comment_id');
    }

    public function postCommentFavoriteIsExistence()
    {
        return PostCommentFavorite::where('user_id',Auth::user()->id)->where('post_comment_id',$this->id)
        ->first() !==null;
    }

    public function comment_favorite() {
       return $this->hasMany(PostCommentFavorite::class);
    }

    //コメント機能
    public static function comment_store($request,$id) {

        $comment = new PostComment();
        $data['comment'] = $request->post_comment;
        $data['post_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();

        $comment->fill($data)->save();

    }
    //コメント編集
    public static function comment_update($request,$post_comment_detail) {

        $data['comment'] = $request->comment;
        $data['updated_at'] = carbon::now();

        return $post_comment_detail->fill($data)->save();
    }

}