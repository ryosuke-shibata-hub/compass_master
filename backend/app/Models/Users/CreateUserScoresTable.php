<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class CreateUserScoresTable extends Model
{

    protected $table = 'user_scores';

    protected $fillable = [
        'user_id',
        'score',
    ];

}