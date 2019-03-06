<?php

namespace App\Http\Middleware;

use App\Models\LogActivities;
use Closure;
use Illuminate\Http\Request;

class ActivityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('ACTIVITY_LOG', false)) {
            try {
                $log = geoip($request->ip())->toArray();
                unset($log['default']);
                unset($log['cached']);
                $log['subject'] = '';
                $log['url'] = $request->url();
                $log['method'] = $request->method();
                $log['ip'] = $request->ip();
                $log['agent'] = $request->header('user-agent');
                $log['user_id'] = \Auth::id();
                LogActivities::create($log);
            } catch (\Exception $e) {
                
            }
        }
        return $next($request);
    }
}
