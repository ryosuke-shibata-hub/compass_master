<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\QuestionBox;
use Auth;

class CheckPostView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post_id = $request->route()->parameter('post');
        $queston_id = $request->route->parameter('quetion');
        Actionlog::create([
            'user_id' => AUth::user()->id,
            'post_id' => $post_id,
            'event_at' => Carbon::now(),
        ]);

        QuestionBox::create([
            'user_id' => Auth::user()->id,
            'question_box_id' => $question_id,
            'event_at' => Carbon::now(),
        ]);

        return $next($request);
    }
}