<?php

namespace App\Policies;

use App\Models\Users\User;
use App\Models\Task\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

        /**
     * 指定されたユーザーが指定されたタスクを削除できるか決定
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user,Task $task)
    {
        return $user->id === $task->user_id;
    }
}