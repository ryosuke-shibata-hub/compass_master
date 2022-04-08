<?php

namespace App\Http\Controllers\User\QuestionBox;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts\QuestionBox;
use App\Models\Posts\QuestionTagCategory;
use Illuminate\Mail\Markdown;
use App\Models\Posts\QuestionComment;
use Illuminate\Support\Facades\DB;
// use App\Support\Markdown;

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
        $dd = $question_detail->answer;

        // $question_detail_comment = DB::table('question_comments')
        // ->where('question_comments.question_box_id',$id)
        // ->select('question_comment')
        // ->first();

        // $markdown_comment = Markdown::parse($question_detail_comment->question_comment);

        $question_comment_detail = QuestionComment::where('question_box_id',$id)
        ->orderBy('event_at','desc')
        ->get();


        $markdown = Markdown::parse(e($question_detail->question_detail));

        return view('QuestionBox.question_detail')
        ->with('question_detail',QuestionBox::questionDetail($id))
        ->with('markdown',$markdown)
        ->with('question_comment_detail',$question_comment_detail);
        // ->with('markdown_comment',$markdown_comment);
    }

    public function create(Request $request)
    {

        // dd($request);
        return view('QuestionBox.question_create')
        ->with('tag_list',QuestionTagCategory::tag_list());
    }
    public function store(Request $request)
    {

        // dd($request);
        QuestionBox::create_new_question($request);
        // dd($request);
        return redirect()->route('question_index');

    }
}