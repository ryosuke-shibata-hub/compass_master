<?php

namespace App\Http\Controllers\User\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\CommentReplies;


class PostCommentRepliesController extends Controller
{
    //
    public function edit($id)
    {
        return redirect()->back();
    }

    public function store(Request $request,$id) {

        CommentReplies::create_replies($request,$id);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $replies_id = CommentReplies::findOrFail($id);
        $replies_id->delete();

        return redirect()->back();
    }
}