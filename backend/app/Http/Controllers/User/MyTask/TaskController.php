<?php

namespace App\Http\Controllers\User\MyTask;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Users\User;
use App\Models\Task\Task;
use App\Repositories\TaskRepository;
use App\Policies\TaskPolicy;

class TaskController extends Controller
{
    //
    protected $tasks;

       public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('Task.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }

    /**
     * 指定タスクの削除
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request,Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();

        return redirect()->back();
    }
}