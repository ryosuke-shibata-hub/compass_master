<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionBox;
use App\Models\Posts\QuestionTagCategory;
use Illuminate\Mail\Markdown;
use App\Models\Posts\QuestionComment;

class QuestionBoxController extends Controller
{
    //

    public function index(Request $request,$question_tag_id = null)
    {
        // dd($request);
        // dd(QuestionBox::question_box_lists($request,$question_tag_id));
        return view('QuestionBox.Top')
        ->with('question_lists',QuestionBox::question_box_lists($request,$question_tag_id))
        ->with('tag_list',QuestionTagCategory::tag_list());
    }

    public function show($id)
    {
        $question_detail = QuestionBox::questionDetail($id);
        $question_comment_detail = QuestionBox::questionDetail($id)->answer;

        $markdown = Markdown::parse(e($question_detail->question_detail));
        $markdownComment = Markdown::parse(e($question_comment_detail));
        // dd($markdown);

        return view('QuestionBox.question_detail')
        ->with('question_detail',QuestionBox::questionDetail($id))
        ->with('markdown',$markdown)
        ->with('markdownComment',$markdownComment);
    }

    public function create(Request $request)
    {

        // dd($request);
        return view('QuestionBox.question_create')
        ->with('tag_list',QuestionTagCategory::tag_list());
    }
    public function store(Request $request)
    {

        QuestionBox::create_new_question($request);
        // dd($request);
        return redirect()->route('question_index');

    }
}