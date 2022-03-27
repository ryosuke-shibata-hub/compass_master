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

    public function questionTagCategory()
    {
        return $this->belongsTo('App\Models\Posts\QuestionTagCategory','question_tag_categories_id');
    }

    public static function questionBoxQuery()
    {
        return self::with([
            'user',
            'questionTagCategory',
        ]);
    }

    public static function question_box_lists($request,$question_tag_id)
    {
        $question_lists = self::questionBoxQuery();
        // ->orderBy('created_at','desc');

        return $question_lists->get();
    }
}