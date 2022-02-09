<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;

class PostFavoritesController extends Controller
{
    //

    public function postFavorite(Request $request) {

        $post_id = $request->post_id;
        $post_favorite_id = $request->post_favorite_id;
        Post::favoriteAndUnFavorite($post_id,$post_favorite_id);

        $post_favorite_count = Post::postDetail($post_id)
        ->userPostFavoriteRelation->count();

        return [$post_favorite_id,$post_favorite_count];
    }
}
