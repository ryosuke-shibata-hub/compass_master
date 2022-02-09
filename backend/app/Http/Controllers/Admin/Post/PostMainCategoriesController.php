<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Http\Requests\PostMainCategoryStoreRequest;

class PostMainCategoriesController extends Controller
{
    //
//メインカテゴリー登録
    public function store(PostMainCategoryStoreRequest $request) {

        $mainCategory = new PostMainCategory();
        $data['main_category'] = $request->main_category;
        $mainCategory->fill($data)->save();

        return redirect()->route('userPostIndex');
    }
//メインカテゴリー削除
     public function destroy($id) {
        PostMainCategory::postMainCategoryDestroy($id);
        return back();
    }


}
