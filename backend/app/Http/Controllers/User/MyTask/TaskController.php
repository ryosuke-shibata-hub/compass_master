<?php

namespace App\Http\Controllers\User\MyTask;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Users\User;
use App\Models\Task\Task;
use App\Repositories\TaskRepository;
use App\Policies\TaskPolicy;
use Auth;
use DB;
use Carbon\Carbon;

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

    public function update(Request $request ,$id)
    {
        $user_id = Auth::user()->id;
        $flg_id = $request->finished_flg;

        if ($user_id == $request->user_id) {

            DB::table('task')
            ->where('id',$id)
            ->update([
                'finished_flg' => $flg_id,
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->back();
        }
        return \App::abort(403,'unauthorized action.');
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