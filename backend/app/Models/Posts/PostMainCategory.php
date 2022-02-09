<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];
//サブカテゴリーとのリレーション
    public function postSubCategory() {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }
//n+1
    public static function postMainCategoryQuery() {
        return self::with('postSubCategory');
    }
//メインカテゴリー、サブカテゴリー取得
    public static function  postMainCategoryList() {
        return self::postMainCategoryQuery()->get();
    }
//メインカテゴリー削除機能
    public static function postMainCategoryDestroy($id) {

        $post_main_category = PostMainCategory::findOrFail($id);
        if ($post_main_category->postSubCatagoryIsExistence($post_main_category)) {
            $post_main_category->delete();
        }
        return \App::abort(403,'unauthorized action.');
    }
//メインカテゴリー有りの際の削除停止
    public static function postSubCatagoryIsExistence($main_data) {

        return $main_data->postSubCategory->isEmpty();
    }

}
