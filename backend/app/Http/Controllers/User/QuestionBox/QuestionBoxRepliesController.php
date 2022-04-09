<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionCommentReplies;

class QuestionBoxRepliesController extends Controller
{
    //

    public function store(Request $request,$id)
    {
        // dd($request);
        QuestionCommentReplies::question_comment_replies_store($request,$id);

        return redirect()->back();
    }
}