<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public function user() {
        return $this->belongsTo(User::Class);
    }

    public function postComment() {
        return $this->belongsTo(PostComment::Class);
    }

}