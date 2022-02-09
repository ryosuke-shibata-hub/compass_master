<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function post() {
        return $this->hasMany('App\Models\Posts\Post');
    }

    public static function postIsExistence($sub_data) {
        return $sub_data->post->isEmpty();
    }

    public static function postSubCategoryDestroy($id) {

        $post_sub_category = PostSubCategory::findOrFail($id);
        if ($post_sub_category->postIsExistence($post_sub_category)) {
            $post_sub_category->delete();
        }
        return \App::abort(403,'unauthorized action.');
    }
}
