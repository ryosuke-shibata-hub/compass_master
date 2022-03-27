<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionBox;

class QuestionBoxController extends Controller
{
    //

    public function index(Request $request,$question_tag_id = null)
    {
        // dd(QuestionBox::question_box_lists($request,$question_tag_id));
        return view('QuestionBox.Top')
        ->with('question_lists',QuestionBox::question_box_lists($request,$question_tag_id));
    }
}