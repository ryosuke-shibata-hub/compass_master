<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Posts\Post;
use Log;
use Auth;


class PostCommentFavoritesController extends Controller
{


    // public function postCommentFavorite(Request $request) {

    //     $post_id = $request->post_id;
    //     $comment_id = $request->comment_id;
    //     $comment_favorite_id = $request->comment_favorite_id;

    //     Post::postCommentFavoriteAndUnFavorite($comment_id,$comment_favorite_id,$post_id);

    //     $comment_favorite_count = Post::postDetail($post_id)
    //     ->postComments->userCommentFavoriteRelation->count();

    //     return [$comment_favorite_id,$comment_favorite_count];
    // }

    public function postCommentFavorite(Request $request) {

        $user_id = Auth::user()->id;
        $comment_id = $request->comment_id;
        $comment_favorite_id = $request->comment_favorite_id;

        $comment_favorite = PostCommentFavorite::where('user_id',$user_id)
        ->where('post_comment_id',$comment_id)->first();

        if(!$comment_favorite) {
            $favorite = new PostCommentFavorite;
            $favorite->post_comment_id = $comment_id;
            $favorite->user_id = $user_id;
            $favorite->save();
        }else{
            PostCommentFavorite::where('post_comment_id',$comment_id)->where('user_id',$user_id)
            ->delete();
        }

        $comment_favorite_count = PostComment::withCount('comment_favorite')->findOrFail($comment_id)->comment_favorite_count;

        return [$comment_favorite_count,$comment_favorite_id];
    }
}