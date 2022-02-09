<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;

class PostsController extends Controller
{
    //

     public function index() {

        return view('Admin.postCategory')
            ->with('post_main_categories',PostMainCategory::postMainCategoryList());
    }
}
