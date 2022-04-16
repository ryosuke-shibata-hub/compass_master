<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class ChatComment extends Model
{
    //
    protected $table = 'chat_comment';

    protected $dates = [
        'created_at',
    ];

    protected $fillable = [
        'recive_user_id',
        'send_user_id',
        'name',
        'comment',
    ];

    protected $guarded = [
        'create_at',
        'updated_at',
    ];
}