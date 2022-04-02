<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

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
        'Question_status',
        'event_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users\User','user_id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Posts\QuestionAnswers');
    }


    public function questionTagCategory()
    {
        return $this->belongsTo('App\Models\Posts\QuestionTagCategory','tag_id');
    }

    public static function questionBoxQuery()
    {
        return self::with([
            'user',
            'questionTagCategory',
            'answer',
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


        return $question_lists->get();
    }
}