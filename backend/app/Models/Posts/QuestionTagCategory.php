<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class QuestionTagCategory extends Model
{
    //
    protected $tables = 'question_tag_categories';
    protected $dates = [
        'created_at',
    ];
    protected $fillable = [
        'id',
        'question_tag',
        'created_at',
        'updated_at',
    ];


    public function question_box_tag() {
        return $this->hasMany('App\Models\Posts\QuestionBox','id');
    }

    public static function tag_list() {

        $tag_list = QuestionTagCategory::select('question_tag_categories.*')
        ->get();

        return $tag_list;
    }
}