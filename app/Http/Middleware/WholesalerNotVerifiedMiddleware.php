<?php

namespace App\Http\Middleware;

use App\Models\LogActivities;
use Closure;
use Illuminate\Http\Request;

class WholesalerNotVerifiedMiddleware
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
        if ($request->user() && ! $request->user()->wholesaler_status) {
            return $next($request);
        }

        return abort(404);
    }
}
