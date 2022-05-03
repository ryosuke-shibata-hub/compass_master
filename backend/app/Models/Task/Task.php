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
        'finished_flg',
    ]);

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task_update($request,$id)
    {
        $task = new Task;

        $data['id'] = $id;
        $data['user_id'] = Auth::user()->id;
        $data['finished_flg'] = $request->finished_flg;
        $data['updated_at'] = Carbon::now();

        return $task->fill($data)->save();
    }
}