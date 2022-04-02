<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswers extends Model
{
    //
    protected $tables = 'question_answers';
    protected $dates = [
        'event_at',
    ];

    protected $fillable = [
        'user_id',
        'question_id',
        'delete_user_id',
        'update_user_id',
        'answer',
        'event_at',
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\Users\User','user_id');
    }
}