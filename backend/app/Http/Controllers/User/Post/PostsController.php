<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostComment;
use App\Models\Posts\CommentReplies;
use App\Models\Posts\Post;
use App\Models\Users\User;
use Log;
use Auth;


class PostsController extends Controller
{
//トップページ
    public function top() {

        $view_count = POST::withCount('Actionlog')
        ->orderBy('actionlog_count','desc')
        ->paginate(3);

        $post_favorite_count = POST::withCount('userPostFavoriteRelation')
        ->orderBy('user_post_favorite_relation_count','desc')
        ->paginate(3);

        $post_comment_count = POST::withCount('postComments')
        ->orderBy('post_comments_count','desc')
        ->paginate(3);

        // dd($post_comment_count);
        return view('User.toppage')
        ->with('view_count',$view_count)
        ->with('post_favorite_count',$post_favorite_count)
        ->with('post_comment_count',$post_comment_count);
    }


//投稿ページ
    public function create() {

        return view('User.create',[
            'post_main_categories' => PostMainCategory::postMainCategoryList(),
        ]);
    }
//投稿機能
    public function store(Request $request) {

       post::create_post($request);
       return redirect()->route('userPostIndex');

    }
//投稿一覧画面
     public function index(Request $request,$subcategory_id = null) {
// dd($request);
        // dd(Post::posts_lists($request,$subcategory_id));
        return view('User.userPost')
        ->with('posts_lists',Post::posts_lists($request,$subcategory_id))
        ->with('postMainCategoryList',PostMainCategory::postMainCategoryList());
    }
//投稿詳細画面
    public function show($id) {
        $postComment = PostComment::withCount('comment_favorite')
        ->where('post_id',$id)
        ->orderBy('updated_at', 'desc')->get();

        return view('User.show')
        ->with('posts_detail',Post::postDetail($id))
        ->with('postComment',$postComment);
    }
//投稿編集画面
    public function edit($id) {

        $post_detail = Post::postDetail($id);

        if (User::contributorAndAdmin($post_detail->user_id)) {

            return view('User.edit')
            ->with('posts_detail',Post::postDetail($id))
            ->with('post_main_category',PostMainCategory::postMainCategoryList());
        }
        return \App::abort(403,'unauthorized action.');
    }
//投稿の更新処理
    public function update(Request $request,$id) {

        $posts_detail = Post::postDetail($id);

        if (User::contributorAndAdmin($posts_detail->user_id)) {
            $posts_detail->postUpdate($request, $posts_detail);
            return redirect()->route('post_show',[$id]);
        }
        return \App::abort(403,'unauthorized action.');
    }
//投稿の削除処理
    public static function destroy($id) {

        $posts_detail = Post::postDetail($id);
        if (User::contributorAndAdmin($posts_detail->user_id)) {
            if($posts_detail->postCommentIsExistence($posts_detail)) {
                $posts_detail->delete();
                return redirect()->route('userPostIndex');
            }
            return \App::abort(404,'unauthorized action.');
        }
        return \App::abort(403,'unauthorized action.');
    }
}