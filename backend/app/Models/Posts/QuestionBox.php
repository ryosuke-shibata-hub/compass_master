<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class QuestionBox extends Model
{
    //
    protected $tables = 'question_boxes';
    protected $dates = [
        'event_at',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'question_box_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'question_detail',
        'tag_id',
        'question_status',
        'event_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users\User','user_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Posts\QuestionComment');
    }
    public function questionTagCategory()
    {
        return $this->belongsTo('App\Models\Posts\QuestionTagCategory','tag_id');
    }
    public function question_comment_reply()
    {
        return $this->hasMany('App\Models\Posts\QuestionCommentReplies');
    }

    public static function questionBoxQuery()
    {
        return self::with([
            'user',
            'questionTagCategory',
            'answer',
            'answer.question_comment_reply',
        ]);
    }

    public static function questionDetail($id)
    {
        return self::questionBoxQuery()->findOrFail($id);
    }
    public static function question_box_lists($request,$question_tag_id)
    {
        $question_lists = self::questionBoxQuery();
        // ->orderBy('created_at','desc');
        $search_tag = $request->tag_id;
        $reset = $request->serach_reset;
        $question_keyword = $request->question_keyword;
        $question_status = $request->question_Status;
// dd($question_status);

        if ($reset) {
            $question_lists = self::questionBoxQuery();
        }

        if($question_keyword) {
            $question_lists = $question_lists
            ->where('title','like','%'.$question_keyword.'%')
            ->orwhere('question_detail','like','%'.$question_keyword.'%')
            ->orwhereIn('tag_id',function($query)use($question_keyword) {
                $query->from('question_tag_categories')
                ->select('id')
                ->where('question_tag',$question_keyword);
            });
        }
        if ($search_tag) {
            $question_lists = $question_lists
                ->orwhereIn('tag_id',function($query)use($search_tag) {
                $query->from('question_tag_categories')
                ->select('id')
                ->where('tag_id',$search_tag);
            });
        }
        if($question_status) {
            $question_lists = $question_lists
            ->where('question_status',$question_status);
        }

        return $question_lists->get();
    }

    public static function create_new_question($request)
    {
        $question = new QuestionBox;
        $data['title'] = $request->title;
        $data['question_detail'] = $request->name;
        $data['user_id'] = Auth::user()->id;
        $data['event_at'] = carbon::now();
        $data['tag_id'] = $request->select_tag_id;
        $data['question_status'] = 0;


        $question->fill($data)->save();
    }

    public static function question_update($question_update)
    {

        $data['update_at'] = carbon::now();
        $data['question_status'] = 1;
        $data['update_user_id'] = Auth::user()->id;

        return $question_update->fill($data)->save();
    }
}