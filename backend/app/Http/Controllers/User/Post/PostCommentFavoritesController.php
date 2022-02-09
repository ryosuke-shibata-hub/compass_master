<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;

class PostCommentFavoritesController extends Controller
{
    //

    public function postCommentFavorite(Request $request) {

        $comment_id = $request->comment_id;
        $comment_favorite_id = $request->comment_favorite_id;

        Post::CommentFavorite($comment_id,$comment_favorite_id);

        $comment_favorite_count = Post::postDetail($comment_id)
        ->userCommentFavoriteRelation->count();

        return [$comment_favorite_id,$comment_favorite_count];
    }
}
