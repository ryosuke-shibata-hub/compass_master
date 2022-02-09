<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\ActionLogs\ActionLog;
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

        Actionlog::create([
            'user_id' => AUth::user()->id,
            'post_id' => $post_id,
            'event_at' => Carbon::now(),
        ]);

        return $next($request);
    }
}
