<?php

namespace App\Models\Task;

use Illuminate\Database\Eloquent\Model;
// use app\Models\Users\User;

class Task extends Model
{
    //
    protected $table = 'task';
    protected $fillable = ([
        'name',
    ]);

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}