<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionBox;
use App\Models\Posts\QuestionTagCategory;

class QuestionBoxController extends Controller
{
    //

    public function index(Request $request,$question_tag_id = null)
    {
        // dd(QuestionTagCategory::tag_list());
        return view('QuestionBox.Top')
        ->with('question_lists',QuestionBox::question_box_lists($request,$question_tag_id))
        ->with('tag_list',QuestionTagCategory::tag_list());
    }
}