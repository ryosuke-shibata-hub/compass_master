<?php

namespace App\Models\Posts;
use Auth;
use Carbon\Carbon;
use App\Models\Users\User;
///
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];
//ユーザーテーブルリレーション
    public function user(){
        return $this->belongsTo('App\Models\Users\User','user_id');
    }
//サブカテゴリーテーブルリレーション
    public function postSubCategory() {
        return $this->belongsTo('App\Models\Posts\PostSubCategory','post_sub_category_id');
    }
//post_commentのリレーション
    public function postComments() {
        return $this->hasMany('App\Models\Posts\PostComment');
    }
//ActionLogとのリレーション
    public function Actionlog() {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }
//userのfavoriteとのリレーション
    public function userPostFavoriteRelation() {
        return $this->belongsToMany('App\Models\Users\User','post_favorites','post_id'
        ,'user_id');
    }
//userのコメントとfavoriteのリレーション
    public function userCommentFavoriteRelation() {
        return $this->belongsToMany('App\Models\Posts\PostComment','post_comment_favorites',
        'post_comment_id','user_id');
    }
//N+1
    public static function postQuery(){
        return self::with([
            'user',
            'postSubCategory',
            'postComments.user',
            'Actionlog',
            'userPostFavoriteRelation',
            'userCommentFavoriteRelation',
        ]);
    }
//post->user,subcate一覧（リレーション）
    public static function posts_lists($request,$subcategory_id) {

        $posts_lists = self::postQuery();
        $keyword = $request->search_keyword;
        $favorite_post = $request->post_favorite;
        $my_post = $request->my_post;

        if($subcategory_id) {
            $posts_lists = $posts_lists->where('post_sub_category_id',$subcategory_id);
        }
        if($keyword) {
            $posts_lists = $posts_lists
            ->where('title','like','%'.$keyword.'%')
            ->orwhere('post','like','%'.$keyword.'%')
            ->orwhereIn('post_sub_category_id',function($query)use($keyword) {
                $query->from('post_sub_categories')
                    ->select('id')
                    ->where('sub_category',$keyword);
            });
        }
        if($favorite_post) {
            $posts_lists = $posts_lists
                ->orwhereIn('id',function($query) {
                    $query->from('post_favorites')
                          ->select('post_id')
                          ->where('user_id',Auth::id());
                });
        }
        if($my_post) {
            $posts_lists = $posts_lists
                ->orwhereIn('id',function($query) {
                    $query->from('posts')
                          ->select('id')
                          ->where('user_id',Auth::id());
                });
        }

        return $posts_lists->get();
    }
//投稿機能
    public static function create_post($request) {

        $post =  new post;
        $data = $request->only('post_sub_category_id','title','post');
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $post->fill($data)->save();

    }
//投稿詳細
   public static function postDetail($id) {
        return self::postQuery()->findOrFail($id);
    }
//投稿編集
    public static function postUpdate($request,$posts_detail)
    {
        $data['post_sub_category_id'] = $request->post_sub_category_id;
        $data['title'] = $request->title;
        $data['post'] = $request->post;

        return $posts_detail->fill($data)->save();
    }

//コメントがある場合削除停止
    public static function postCommentIsExistence($posts_detail) {
        return $posts_detail->postComments->isEmpty();
    }
//いいね機能
    public static function favoriteAndUnFavorite($post_id,$post_favorite_id) {

        $posts_detail = self::findOrFail($post_id);

        if($post_favorite_id) {
            return $posts_detail->userPostFavoriteRelation()->detach(Auth::id());
        }else{
            return $posts_detail->userPostFavoriteRelation()->attach(Auth::id());
        }
    }
//コメントへのいいね機能
    public static function CommentFavorite($comment_id,$comment_favorite_id) {

        $posts_detail = self::findOrFail($comment_id);

        if($comment_favorite_id) {
            return $posts_detail->userCommentFavoriteRelation()->detach(Auth::id());
        }else{
            return $posts_detail->userCommentFavoriteRelation()->attach(Auth::id());
        }
    }
//いいねしているかの判断(投稿)
    public static function postFavoriteIsExistence($posts_detail) {

        return is_null($posts_detail->userPostFavoriteRelation->find(Auth::id()));
    }
//いいねしているかの判断(コメント)
    public static function postCommentFavoriteIsExistence($posts_detail) {

        return is_null($posts_detail->userCommentFavoriteRelation
        ->find(Auth::id()));
    }
}