<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionBox;
use App\Models\Posts\QuestionTagCategory;
use Illuminate\Mail\Markdown;
use App\Models\Posts\QuestionComment;
use Illuminate\Support\Facades\DB;
use App\Models\Users\User;

class QuestionBoxController extends Controller
{
    //

    public function index(Request $request,$question_tag_id = null)
    {

        return view('QuestionBox.Top')
        ->with('question_lists',QuestionBox::question_box_lists($request,$question_tag_id))
        ->with('tag_list',QuestionTagCategory::tag_list());
    }

    public function show($id)
    {

        $question_detail = QuestionBox::questionDetail($id);
// dd($question_detail);
        $question_comment_detail = QuestionComment::where('question_id',$id)
        ->orderBy('event_at','desc')
        ->get();


        $markdown = Markdown::parse(e($question_detail->question_detail));

        return view('QuestionBox.question_detail')
        ->with('question_detail',QuestionBox::questionDetail($id))
        ->with('markdown',$markdown)
        ->with('question_comment_detail',$question_comment_detail);
    }

    public function create(Request $request)
    {

        return view('QuestionBox.question_create')
        ->with('tag_list',QuestionTagCategory::tag_list());
    }
    public function store(Request $request)
    {

        QuestionBox::create_new_question($request);
        return redirect()->route('question_index');

    }
    public function update(Request $request,$id)
    {

        $question_update = QuestionBox::questionDetail($id);

        if (User::contributorAndAdmin($question_update->user_id)) {
            $question_update->question_update($question_update);
            return redirect()->back();
        }
        return \App::abort(403,'unauthorized action.');
    }
}