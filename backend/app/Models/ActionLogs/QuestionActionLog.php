<?php

namespace App\Models\ActionLogs;

use Illuminate\Database\Eloquent\Model;

class QuestionActionLog extends Model
{
    protected $table = 'question_action_logs';

    protected $fillable = [
        'user_id',
        'question_id',
        'event_at',
    ];
}