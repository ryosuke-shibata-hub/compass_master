<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use App\Models\Posts\post;
use Auth;

class PostCommentsController extends Controller
{
    //
    public function store(Request $request,$id) {
//コメント機能
        PostComment::comment_store($request,$id);
        return back();
    }

    public function edit($id) {

        $post_comment_detail = PostComment::findOrFail($id);

        if(Auth::user()->contributorAndAdmin($post_comment_detail->user_id)){

        return view('post_comment.edit')
        ->with('post_comment_detail',$post_comment_detail);
        }
        return \App::abort(403, 'Unauthorized action.');
    }

    public function update(Request $request,$id) {

        $post_comment_detail = PostComment::findOrFail($id);

        if(Auth::user()->contributorAndAdmin($post_comment_detail->user_id)){
            $post_comment_detail->comment_update($request,$post_comment_detail);

            return redirect()->route('post_show',[$post_comment_detail->post_id]);
    }
     return \App::abort(403, 'Unauthorized action.');
}
    public function destroy($id) {

        $post_comment_detail = PostComment::findOrFail($id);

        if(Auth::user()->contributorAndAdmin($post_comment_detail->user_id)) {
            $post_comment_detail->delete();
            return redirect()->route('post_show',[$post_comment_detail->post_id]);
        }
            return \App::abort(403, 'Unauthorized action.');
    }

}
