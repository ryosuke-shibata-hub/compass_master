<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionComment;

class QuestionCommentController extends Controller
{
    //
    public function store(Request $request,$id)
    {
        // dd($id);
        // dd($request);
        QuestionComment::question_comment_store($request,$id);

        return redirect()->back();
    }
}